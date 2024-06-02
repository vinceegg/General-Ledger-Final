<?php

namespace App\Livewire;

use App\Exports\GeneralJournalExport;
use App\Imports\GeneralJournalImport;
use App\Models\GeneralJournalModel;
use App\Models\GeneralJournal_AccountCodesModel; //@korinlv: added  this
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use App\Models\LedgerSheetModel;

class GeneralJournalShow extends Component
{
    use WithFileUploads;
    
    public $gj_entrynum_date,
    $generaljournal_no,
    $gj_jevnum,
    $gj_particulars,
    $gj_accountcodes_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'generaljournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    // Validation rules
    //@korin:edited this
    protected function rules()
    {
        return [
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|string',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data' => 'required|array|min:1',
            'gj_accountcodes_data.*.gj_accountcode' => 'nullable|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric|min:0|max:10000000000',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric|min:0|max:10000000000',
        ];
    }

    // Validate when fields are updated
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    //@korinlv: added this function
    public function mount()
    {
        // Fetch existing sundry data for the given journal ID
        $journal = GeneralJournalModel::find($this->generaljournal_no);

        if ($journal && $journal->gj_accountcodes_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->gj_accountcodes_data = $journal->gj_accountcodes_data->toArray();
        } else {
            // Example initialization, you might load this from a database or start with an empty array
            $this->gj_accountcodes_data = [
                ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => '']
            ];
        }
    }
    
    // Save new GeneralJournal
    //@korinlv: updated this function
    public function saveGeneralJournal()
    {
        $validatedData = $this->validate();

        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $journal = GeneralJournalModel::create($validatedData);

        foreach ($validatedData['gj_accountcodes_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $journal->gj_accountcodes_data()->create([
                'gj_accountcode' => $code['gj_accountcode'],
                'gj_debit' => $code['gj_debit'],
                'gj_credit' => $code['gj_credit'],
            ]);
        }

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;

        $this->resetInput();

        $this->dispatch('notification-shown');  
    } 

    //VINCE REMEMBER
    public function saveLedgerSheetCode()
    {
        $this->validate([
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string|max:255', // Validate the account code
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric', // Validate the debit amount
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric', // Validate the credit amount
        ]);
    
        foreach ($this->gj_accountcodes_data as $code) {
            $debit = $code['gj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['gj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['gj_accountcode']) {
                case '1 01 01 010 - Cash Local Treasury':
                    $credit = null; // Set credit to null for Cash Local Treasury
                    break;
                case '1 03 01 010 - Accounts Receivable':
                    $credit = null; // Set credit to null for Accounts Receivable
                    break;
                case '5 02 99 050 - Rent Income':
                    $debit = null; // Set debit to null for Rent Income
                    break;
                case '1 01 01 020 - Petty Cash':
                    $credit = null; // Set credit to null for Cash Local Treasury
                    break;
                case '1 01 02 010 - Cash in Bank - Local Current Account':
                    $credit = null; // Set credit to null for Accounts Receivable
                    break;
                case '1 02 01 010 - Cash in Bank - Local Currency Time Deposits':
                    $credit = null; // Set debit to null for Rent Income
                    break;
                case '1 03 01 070 - Interests Receivable':
                    $credit = null; // Set credit to null for Cash Local Treasury
                    break;
                
            }
    
            LedgerSheetModel::create([
                'ls_vouchernum' => $this->gj_jevnum, // Use journal entry voucher number
                'ls_date' => $this->gj_entrynum_date, // Use the date from the journal entry
                'ls_particulars' => $this->gj_particulars, // Use the particulars from the journal entry
                'ls_accountname' => $code['gj_accountcode'], // The account code from the input
                'ls_debit' => $debit, // Debit amount, modified conditionally
                'ls_credit' => $credit, // Credit amount, modified conditionally
                'ls_credit_balance' => null,
                'ls_balance_debit' => null
            ]);
        }
    
        // Notification message to show that the operation was successful
        $this->notificationMessage = 'Ledger entries added successfully';
        $this->showNotification = true;
    }

    //@korinlv: added this function
    public function addAccountCode()
    {
        $this->gj_accountcodes_data[] = ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => ''];
        logger('Account code added', $this->gj_accountcodes_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->gj_accountcodes_data[$index]);
        $this->gj_accountcodes_data = array_values($this->gj_accountcodes_data);
        logger('Account code removed', $this->gj_accountcodes_data);
    }

    // Edit GeneralJournal
    //@korinlv: updated this function
    public function editGeneralJournal($generaljournal_no)
    {
        $generalJournal = GeneralJournalModel::with('gj_accountcodes_data')->find($generaljournal_no);
        if ($generalJournal) {
            $this->generaljournal_no = $generalJournal->generaljournal_no;

            $this->gj_jevnum = $generalJournal->gj_jevnum;
            $this->gj_entrynum_date = $generalJournal->gj_entrynum_date;
            $this->gj_particulars = $generalJournal->gj_particulars;
            // Handle related data as array of objects or similar structure
            $this->gj_accountcodes_data = $generalJournal->gj_accountcodes_data->toArray();
        } 
    }
   // Update GeneralJournal
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateGeneralJournal()
    {
        $validatedData = $this->validate([
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|string',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $generalJournal = GeneralJournalModel::findOrFail($this->generaljournal_no);
            $generalJournal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $generalJournal->gj_accountcodes_data->pluck('gj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->gj_accountcodes_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['gj_id']) && $data['gj_id']) {
                    // Update existing account code
                    $accountCode = GeneralJournal_AccountCodesModel::find($data['gj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['gj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $generalJournal->gj_accountcodes_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->gj_id;

                    // Reset other fields except the newly added sundry entry
                    $this->gj_accountcodes_data[] = ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => ''];
                }
            }

        // Calculate sundry data IDs to delete (those that are not in the incoming data)
        $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

        // Delete sundry data not in the incoming data
        GeneralJournal_AccountCodesModel ::destroy($sundryIdsToDelete);

        // Update notification state
        $this->notificationMessage = 'Updated Successfully';
        $this->showNotification = true;
        $this->resetInput();

        // Dispatch browser event to handle notification visibility
        $this->dispatch('notification-shown');

        $this->dispatch('close-modal');
    }

    // Close modal and reset input
    public function closeModal()
    {
        $this->resetInput();
    }

    // Reset input values
    //@korinlv: edited this function
    public function resetInput()
    {
        $this->gj_entrynum_date = '';
        $this->gj_jevnum = '';
        $this->gj_particulars = '';
        $this->gj_accountcodes_data = [];
    }

    // Sorting logic SA SORT TO KORINNE HA
    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function softDeleteGeneralJournal($generaljournal_no)
    {
        $general_journal = GeneralJournalModel::with('gj_accountcodes_data')->find($generaljournal_no);
        if ($general_journal) {
            // Delete the related sundries first
            foreach ($general_journal->gj_accountcodes_data as $sundry) {
                $sundry->delete();
            }

        // Now soft delete the journal
        $general_journal->delete();
        session()->flash('message', 'Soft Deleted Successfully');
    }

        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function importGJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new GeneralJournalImport, $filePath);

        return redirect()->back()->with('success', 'Data imported successfully');
        }
    }

    // @korin: edited this function
    public function exportGJ_XLSX(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.xlsx');
    }
    public function exportGJ_CSV(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.csv');
    }

    public function searchAction()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since it's just a placeholder, you don't need to add any code here.
    }

    public function sortAction()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    }

    public function sortDate()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    }
    
        // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }

    // Render the component
    public function render()
    {
        $query = GeneralJournalModel::query();
        
        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('gj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('gj_jevnum', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $general_journal = $query->orderBy('gj_jevnum', 'ASC')->get(); // Changed from paginate() to get()

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}