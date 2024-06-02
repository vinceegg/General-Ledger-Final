<?php

namespace App\Livewire;

use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\CashDisbursementJournalExport;
use App\Imports\CashDisbursementJournalImport;
use App\Models\CDJ_SundryModel;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LedgerSheetModel;

class CashDisbursementJournalShow extends Component
{
    use WithFileUploads;

    public $cdj_entrynum_date,
    $cashdisbursementjournal_no,
    $cdj_referencenum,
    $cdj_bur,
    $cdj_accountable_officer,
    $cdj_jevnum,
    $cdj_credit_accountcode,
    $cdj_amount,
    $cdj_account1,
    $cdj_account2,
    $cdj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'cashdisbursementjournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalAmount = 0;
    public $totalAccount1 = 0;
    public $totalAccount2 = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    //@korin:edited this
    protected function rules()
    {
        return [
            'cdj_jevnum'=>'nullable|string',
            'cdj_entrynum_date'=>'nullable|date',
            'cdj_referencenum'=>'nullable|string',
            'cdj_bur'=>'nullable|integer',
            'cdj_accountable_officer'=>'nullable|string',
            'cdj_credit_accountcode'=>'nullable|string',
            'cdj_amount'=> 'nullable|numeric',
            'cdj_account1'=> 'nullable|numeric',
            'cdj_account2'=> 'nullable|numeric',
            'cdj_sundry_data'=>'required|array|min:1',
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*.cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*.cdj_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'cdj_sundry_data.*.cdj_credit'=> 'nullable|numeric|min:0|max:1000000000',
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
        $cash_disbursement_journal = CashDisbursementJournalModel::find($this->cashdisbursementjournal_no);

        if ($cash_disbursement_journal && $cash_disbursement_journal->cdj_sundry_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->cdj_sundry_data = $cash_disbursement_journal->cdj_sundry_data->toArray();
        } else {
            // If the database is empty, initialize with an empty structure
            $this->cdj_sundry_data = [
                ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => '']
            ];
        }
    }

    //@korinlv: updated this function
    public function saveCashDisbursementJournal()
    {
        $validatedData = $this->validate();
        
        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $cash_disbursement_journal = CashDisbursementJournalModel::create($validatedData);

        foreach ($validatedData['cdj_sundry_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $cash_disbursement_journal->cdj_sundry_data()->create([
                'cdj_sundry_accountcode' => $code['cdj_sundry_accountcode'],
                'cdj_pr' => $code['cdj_pr'],
                'cdj_debit' => $code['cdj_debit'],
                'cdj_credit' => $code['cdj_credit'],
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
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*.cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*.cdj_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'cdj_sundry_data.*.cdj_credit'=> 'nullable|numeric|min:0|max:1000000000',
        ]);
    
        foreach ($this->cdj_sundry_data as $code) {
            $debit = $code['cdj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['cdj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['cdj_sundry_accountcode']) {
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
                'ls_vouchernum' => $this->cdj_jevnum, 
                'ls_date' => $this->cdj_entrynum_date, 
                'ls_particulars' => $this->cdj_accountable_officer, 
                'ls_accountname' => $code['cdj_sundry_accountcode'], 
                'ls_debit' => $debit, 
                'ls_credit' => $credit, 
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
        $this->cdj_sundry_data[] = ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => ''];
        logger('Sundry added', $this->cdj_sundry_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->cdj_sundry_data[$index]);
        $this->cdj_sundry_data = array_values($this->cdj_sundry_data);
        logger('Sundry removed', $this->cdj_sundry_data);
    }

    //@korinlv: updated this function
    public function editCashDisbursementJournal($cashdisbursementjournal_no)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::find($cashdisbursementjournal_no);
        if ($cash_disbursement_journal) {
            $this->cashdisbursementjournal_no =  $cash_disbursement_journal->$cashdisbursementjournal_no;
            $this->cdj_jevnum = $cash_disbursement_journal->cdj_jevnum;
            $this->cdj_entrynum_date = $cash_disbursement_journal->cdj_entrynum_date;
            $this->cdj_referencenum = $cash_disbursement_journal->cdj_referencenum;
            $this->cdj_bur = $cash_disbursement_journal->cdj_bur;
            $this->cdj_accountable_officer = $cash_disbursement_journal->cdj_accountable_officer;           
            $this->cdj_credit_accountcode = $cash_disbursement_journal->cdj_credit_accountcode;
            $this->cdj_amount = $cash_disbursement_journal->cdj_amount;
            $this->cdj_account1 = $cash_disbursement_journal->cdj_account1;
            $this->cdj_account2 = $cash_disbursement_journal->cdj_account2;

            $this->cdj_sundry_data = $cash_disbursement_journal->cdj_sundry_data->toArray();
        }
    }

    //NEW VERSION NG 'UPDATE' MAS MAHABA, WHY THO?
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateCashDisbursementJournal()
    {
        $validatedData = $this->validate([
            'cdj_jevnum'=>'nullable|string',
            'cdj_entrynum_date'=>'nullable|date',
            'cdj_referencenum'=>'nullable|string',
            'cdj_bur'=>'nullable|integer',
            'cdj_accountable_officer'=>'nullable|string',           
            'cdj_credit_accountcode'=>'nullable|string',
            'cdj_amount'=> 'nullable|numeric',
            'cdj_account1'=> 'nullable|numeric',
            'cdj_account2'=> 'nullable|numeric',
            'cdj_sundry_data' => 'required|array|min:1',
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*cdj_debit'=> 'nullable|numeric|min:0|max:100000000',
            'cdj_sundry_data.*cdj_credit'=> 'nullable|numeric|min:0|max:100000000',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $cash_disbursement_journal = CashDisbursementJournalModel::findOrFail($this->cashdisbursementjournal_no);
            $cash_disbursement_journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $cash_disbursement_journal->cdj_sundry_data->pluck('cdj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->cdj_sundry_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['cdj_id']) && $data['cdj_id']) {
                    // Update existing account code
                    $accountCode = CDJ_SundryModel::find($data['cdj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['cdj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $cash_disbursement_journal->cdj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->id;

                    // Reset other fields except the newly added sundry entry
                    $this->cdj_sundry_data[] = ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => ''];
                }
            }

            // Calculate sundry data IDs to delete (those that are not in the incoming data)
            $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

            // Delete sundry data not in the incoming data
            CDJ_SundryModel::destroy($sundryIdsToDelete);

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
            $this->cdj_jevnum = '';
            $this->cdj_entrynum_date = '';
            $this->cdj_referencenum = '';
            $this->cdj_bur = '';
            $this->cdj_accountable_officer = '';        
            $this->cdj_credit_accountcode ='';
            $this->cdj_amount = '';
            $this->cdj_account1 = '';
            $this->cdj_account2 = '';
            $this->cdj_sundry_data = [];

    }

    //@korinlv: edited this function
    public function softDeleteCashDisbursementJournal($cashdisbursementjournal_no)
    {
        $cash_disbursement_journal= CashDisbursementJournalModel::find($cashdisbursementjournal_no);
        if ( $cash_disbursement_journal) {
            foreach ($cash_disbursement_journal->cdj_sundry_data as $accountCode){
                $accountCode->delete();
            }
            
            $cash_disbursement_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function importCDJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CashDisbursementJournalImport, $filePath);

        return redirect()->back();
        }
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    // @korin: edited this function
    public function exportCDJ_XLSX(Request $request) 
    {
        return Excel::download(new CashDisbursementJournalExport, 'CDJ.xlsx');
    }
    public function exportCDJ_CSV(Request $request) 
    {
        return Excel::download(new CashDisbursementJournalExport, 'CDJ.csv');
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

    public function render()
    {
        $query = CashDisbursementJournalModel::query();

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('cdj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('cdj_jevnum', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $this->totalAmount = $query->sum('cdj_amount');
        $this->totalAccount1 = $query->sum('cdj_account1');
        $this->totalAccount2 = $query->sum('cdj_account2');

        // Get paginated results
        $cash_disbursement_journal = $query->get();
        return view('livewire.cash-disbursement-journal-show',['cash_disbursement_journal' => $cash_disbursement_journal]);
    }
}