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

class CashReceiptJournalShow extends Component
{
    use WithFileUploads;

    public $crj_entrynum_date,
    $crj_jevnum,
    $crj_payor,
    $crj_collection_debit,
    $crj_collection_credit,
    $crj_deposit_debit,
    $crj_deposit_credit,
    $crj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $cash_receipt_journal_id; // Add this property
    public $selectedMonth;
    public $sortField = 'crj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCollectionDebit = 0;
    public $totalCollectionCredit = 0;
    public $totalDepositDebit = 0;
    public $totalDepositCredit = 0;
    public $viewDeleted = false; // Property to toggle deleted records view
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    protected function rules()
    {
        return [
            'crj_entrynum_date' => 'nullable|date',
            'crj_jevnum' => 'nullable|integer',
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric',
            'crj_collection_credit' => 'nullable|numeric',
            'crj_deposit_debit' => 'nullable|numeric',
            'crj_deposit_credit' => 'nullable|numeric',
            'crj_sundry_data' => 'required|array|min:1',
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:100000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:100000000',
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
        $journal = CashReceiptJournalModel::find($this->cash_receipt_journal_id);

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
    public function editCashReceiptJournal(int $cash_receipt_journal_id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::with('crj_sundry_data')->find($cash_receipt_journal_id);
        if ($cash_receipt_journal) {

            $this->cash_receipt_journal_id = $cash_receipt_journal->id;
            $this->crj_entrynum_date = $cash_receipt_journal->crj_entrynum_date;
            $this->crj_jevnum = $cash_receipt_journal->crj_jevnum;
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
            'crj_entrynum_date' => 'nullable|date',
            'crj_jevnum' => 'nullable|integer',
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

            $cash_receipt_journal = CashReceiptJournalModel::findOrFail($this->cash_receipt_journal_id);
            $cash_receipt_journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $cash_receipt_journal->crj_sundry_data->pluck('id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->crj_sundry_data as $key => $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['id']) && $data['id']) {
                    // Update existing account code
                    $accountCode = CRJ_SundryModel::find($data['id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $cash_receipt_journal->crj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->id;
                    
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


    //DELETE FUNCTION
    public function deleteCashReceiptJournal(int $cash_receipt_journal_id, $type = 'soft')
    {
        $this->cash_receipt_journal_id = $cash_receipt_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyCashReceiptJournal()
    {
        $cash_receipt_journal = CashReceiptJournalModel::withTrashed()->find($this->cash_receipt_journal_id);
        if ($this->deleteType == 'force') {
            $cash_receipt_journal->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cash_receipt_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
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
    public function softDeleteCashReceiptJournal($cash_receipt_journal_id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::with('crj_sundry_data')->find($cash_receipt_journal_id);
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

    public function importViewCRJ(){
        return view('journals.CRJ');
    }

    //EXPORT FUNCTION
    public function exportCRJ(Request $request){
        return Excel::download(new CashReceiptJournalExport, 'CRJ.xlsx');
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


    // Method to toggle viewDeleted
    public function toggleDeletedView()
    {
        $this->viewDeleted = !$this->viewDeleted;
    }


    // Method to restore soft-deleted record
    //@korinlv: edited this function
    public function restoreCashReceiptJournal($id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::onlyTrashed()->find($id);
        if ($cash_receipt_journal) {
            $trashedAccountCodes = $cash_receipt_journal->crj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedAccountCodes as $accountCode){
                $accountCode->restore();
            }
            $cash_receipt_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }
    
    public function totalsCashReceiptJournal($query){
        //@korinlv:added this function
        $cash_receipt_journals = $query->with(['crj_sundry_data' => function($query){
            if ($this->viewDeleted) {
                $query->onlyTrashed();
            }
        }])->get();
                
        $totalDebit = 0;
        $totalCredit = 0;
        
        foreach ($cash_receipt_journals as $journal) {
            foreach ($journal->crj_sundry_data ?: [] as $sundry) { // Ensure sundry data is treated as an array
                $totalDebit += $sundry->crj_debit ?? 0;
                $totalCredit += $sundry->crj_credit ?? 0;
            }
        }
            
        $this->totalDebit = $totalDebit;
        $this->totalCredit = $totalCredit;
    }

    public function render()
    {
        $query = CashReceiptJournalModel::query();

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('crj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        $this->totalsCashReceiptJournal($query);
        

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

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