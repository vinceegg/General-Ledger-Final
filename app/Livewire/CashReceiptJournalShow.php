<?php

namespace App\Livewire;

use App\Exports\CashReceiptJournalExport;
use App\Imports\CashReceiptJournalImport;
use App\Models\CashReceiptJournalModel;
use App\Models\CRJ_SundryModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use App\Models\LedgerSheetModel;

class CashReceiptJournalShow extends Component
{
    use WithFileUploads;

    public $crj_entrynum_date,
    $cashreceiptjournal_no,
    $crj_jevnum,
    $crj_payor,
    $crj_collection_debit,
    $crj_collection_credit,
    $crj_deposit_debit,
    $crj_deposit_credit,
    $crj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'cashreceiptjournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCollectionDebit = 0;
    public $totalCollectionCredit = 0;
    public $totalDepositDebit = 0;
    public $totalDepositCredit = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    protected function rules()
    {
        return [
            'crj_jevnum' => 'nullable|string',
            'crj_entrynum_date' => 'nullable|date',        
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric',
            'crj_collection_credit' => 'nullable|numeric',
            'crj_deposit_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_deposit_credit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data' => 'required|array|min:1',
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:1000000000',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    //@korinlv: added this function
    public function mount()
    {
        // Fetch existing sundry data for the given journal ID
        $journal = CashReceiptJournalModel::find($this->cashreceiptjournal_no);

        if ($journal && $journal->crj_sundry_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->crj_sundry_data = $journal->crj_sundry_data->toArray();
        } else {
            // If the database is empty, initialize with an empty structure
            $this->crj_sundry_data = [
                ['crj_accountcode' => '', 'crj_debit' => '', 'crj_credit' => '']
            ];
        }
    }

    //@korinlv: updated this function
    public function saveCashReceiptJournal()
    {
        $validatedData = $this->validate();
        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $journal = CashReceiptJournalModel::create($validatedData);

        foreach ($validatedData['crj_sundry_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $journal->crj_sundry_data()->create([
                'crj_accountcode' => $code['crj_accountcode'],
                'crj_debit' => $code['crj_debit'],
                'crj_credit' => $code['crj_credit'],
            ]);

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;
        $this->dispatch('notification-shown');
        $this->resetInput();     
        }
    }

    //VINCE REMEMBER
    public function saveLedgerSheetCode()
    {
        $this->validate([
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:1000000000',
        ]);
    
        foreach ($this->crj_sundry_data as $code) {
            $debit = $code['crj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['crj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['crj_accountcode']) {
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
                'ls_vouchernum' => $this->crj_jevnum, 
                'ls_date' => $this->crj_entrynum_date, 
                'ls_particulars' => $this->crj_payor, 
                'ls_accountname' => $code['crj_accountcode'], 
                'ls_debit' => $debit, 
                'ls_credit' => $credit, 
                'ls_credit_balance' => null,
                'ls_balance_debit' => null
            ]);
        }
    }

    //@korinlv: added this function
    public function addAccountCode()
    {
        $this->crj_sundry_data[] = ['crj_accountcode' => '', 'crj_debit' => '', 'crj_credit' => ''];
        logger('Sundry added', $this->crj_sundry_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->crj_sundry_data[$index]);
        $this->crj_sundry_data = array_values($this->crj_sundry_data);
        logger('Sundry removed', $this->crj_sundry_data);
    }

    //EDIT FUNCTION
    //@korinlv: updated this function
    public function editCashReceiptJournal($cashreceiptjournal_no)
    {
        $cash_receipt_journal = CashReceiptJournalModel::with('crj_sundry_data')->find($cashreceiptjournal_no);
        if ($cash_receipt_journal) {
            $this->cashreceiptjournal_no = $cash_receipt_journal->$cashreceiptjournal_no;
            $this->crj_jevnum = $cash_receipt_journal->crj_jevnum;
            $this->crj_entrynum_date = $cash_receipt_journal->crj_entrynum_date;       
            $this->crj_payor = $cash_receipt_journal->crj_payor;
            $this->crj_collection_debit = $cash_receipt_journal->crj_collection_debit;
            $this->crj_collection_credit = $cash_receipt_journal->crj_collection_credit;
            $this->crj_deposit_debit = $cash_receipt_journal->crj_deposit_debit;
            $this->crj_deposit_credit = $cash_receipt_journal->crj_deposit_credit;
            
            // Handle related data as array of objects or similar structure
            $this->crj_sundry_data = $cash_receipt_journal->crj_sundry_data->toArray();
        } 
    }

    //UPDATE FUNCTION
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateCashReceiptJournal()
    {
        $validatedData = $this->validate([
            'crj_jevnum' => 'nullable|string',
            'crj_entrynum_date' => 'nullable|date',           
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric',
            'crj_collection_credit' => 'nullable|numeric',
            'crj_deposit_debit' => 'nullable|numeric',
            'crj_deposit_credit' => 'nullable|numeric',
            'crj_sundry_data' => 'required|array|min:1',
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:100000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:100000000',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $cash_receipt_journal = CashReceiptJournalModel::findOrFail($this->cashreceiptjournal_no);
            $cash_receipt_journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $cash_receipt_journal->crj_sundry_data->pluck('crj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->crj_sundry_data as $key => $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['crj_id']) && $data['crj_id']) {
                    // Update existing account code
                    $accountCode = CRJ_SundryModel::find($data['crj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['crj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $cash_receipt_journal->crj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->ckdj_id;
                    
                    // Reset other fields except the newly added sundry entry
                    $this->crj_sundry_data[$key] = ['crj_accountcode' => '', 'crj_debit' => '', 'crj_credit' => ''];
                }
            }

            // Calculate sundry data IDs to delete (those that are not in the incoming data)
            $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

            // Delete sundry data not in the incoming data
            CRJ_SundryModel::destroy($sundryIdsToDelete);

            // Update notification state
            $this->notificationMessage = 'Updated Successfully';
            $this->showNotification = true;
            $this->resetInput();

            // Dispatch browser event to handle notification visibility
            $this->dispatch('notification-shown');

            $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    //@korinlv: edited this function
    public function resetInput()
    {
        $this->crj_entrynum_date = '';
        $this->crj_jevnum = '';
        $this->crj_payor = '';
        $this->crj_collection_debit = '';
        $this->crj_collection_credit = '';
        $this->crj_deposit_debit = '';
        $this->crj_deposit_credit = '';
        $this->crj_sundry_data = [];
    }

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }

    // Soft delete CashReceiptJournal
    //@korinlv: edited this function
    public function softDeleteCashReceiptJournal($cashreceiptjournal_no)
    {
        $cash_receipt_journal = CashReceiptJournalModel::with('crj_sundry_data')->find($cashreceiptjournal_no);
        if ($cash_receipt_journal) {
            // Delete the related sundries first
            foreach ($cash_receipt_journal->crj_sundry_data as $sundry) {
                $sundry->delete();
            }

        // Now soft delete the journal
        $cash_receipt_journal->delete();
        session()->flash('message', 'Soft Deleted Successfully');
    }

        $this->resetInput();
        $this->dispatch('close-modal');
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
    
    public function importCRJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CashReceiptJournalImport, $filePath);

        return redirect()->back();
        }
    }

    // @korin: edited this function
    public function exportCRJ_XLSX(Request $request) 
    {
        return Excel::download(new CashReceiptJournalExport, 'CRJ.xlsx');
    }
    public function exportCRJ_CSV(Request $request) 
    {
        return Excel::download(new CashReceiptJournalExport, 'CRJ.csv');
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

    public function render()
    {
        $query = CashReceiptJournalModel::query();

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('crj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('crj_jevnum', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);
        $this->totalCollectionDebit = $query->sum('crj_collection_debit');
        $this->totalCollectionCredit = $query->sum('crj_collection_credit');
        $this->totalDepositDebit = $query->sum('crj_deposit_debit');
        $this->totalDepositCredit = $query->sum('crj_deposit_credit');

        // Get paginated results
        $cash_receipt_journal = $query->get();

        return view('livewire.cash-receipt-journal-show',['cash_receipt_journal' => $cash_receipt_journal]);
    }
}