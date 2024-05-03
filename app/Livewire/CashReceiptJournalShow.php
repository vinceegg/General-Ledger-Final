<?php

namespace App\Livewire;

use App\Exports\CashReceiptJournalExport;
use App\Imports\CashReceiptJournalImport;
use Livewire\WithPagination;
use App\Models\CashReceiptJournalModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CashReceiptJournalShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public 
    $crj_entrynum_date,
    $crj_jevnum,
    $crj_payor,
    $crj_collection_debit,
    $crj_collection_credit,
    $crj_deposit_debit,
    $crj_deposit_credit,
    $crj_accountcode,
    $crj_debit,
    $crj_credit,
    $cash_receipt_journal_id,
    $deleteType; // Added deleteType property

    public $search;
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


    protected function rules()
    {
        return [
            'crj_entrynum_date' => 'nullable|date',
            'crj_jevnum' => 'nullable|integer',
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric|min:0|max:100000000',
            'crj_collection_credit' => 'nullable|numeric|min:0|max:100000000',
            'crj_deposit_debit' => 'nullable|numeric|min:0|max:100000000',
            'crj_deposit_credit' => 'nullable|numeric|min:0|max:100000000',
            'crj_accountcode' => 'nullable|string',
            'crj_debit' => 'nullable|numeric|min:0|max:100000000',
            'crj_credit' => 'nullable|numeric|min:0|max:100000000',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCashReceiptJournal()
    {
        $validatedData = $this->validate();

        CashReceiptJournalModel::create($validatedData);
        session()->flash('message', 'Added Successfully');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    //EDIT FUNCTION
    public function editCashReceiptJournal(int $cash_receipt_journal_id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::find($cash_receipt_journal_id);
        if ($cash_receipt_journal) {

            $this->cash_receipt_journal_id = $cash_receipt_journal->id;
            $this->crj_entrynum_date = $cash_receipt_journal->crj_entrynum_date;
            $this->crj_jevnum = $cash_receipt_journal->crj_jevnum;
            $this->crj_payor = $cash_receipt_journal->crj_payor;
            $this->crj_collection_debit = $cash_receipt_journal->crj_collection_debit;
            $this->crj_collection_credit = $cash_receipt_journal->crj_collection_credit;
            $this->crj_deposit_debit = $cash_receipt_journal->crj_deposit_debit;
            $this->crj_deposit_credit = $cash_receipt_journal->crj_deposit_credit;
            $this->crj_accountcode = $cash_receipt_journal->crj_accountcode;
            $this->crj_debit = $cash_receipt_journal->crj_debit;
            $this->crj_credit = $cash_receipt_journal->crj_credit;
        } 
        else {
            return redirect() -> to('/cash_receipt_journal'); 
        }
    }

    //UPDATE FUNCTION
    public function updateCashReceiptJournal()
    {
        $validatedData = $this->validate();

        CashReceiptJournalModel::where('id', $this->cash_receipt_journal_id)->update([
            'crj_entrynum_date' => $validatedData['crj_entrynum_date'],
            'crj_jevnum' => $validatedData['crj_jevnum'],
            'crj_payor' => $validatedData['crj_payor'],
            'crj_collection_debit' => $validatedData['crj_collection_debit'],
            'crj_collection_credit' => $validatedData['crj_collection_credit'],
            'crj_deposit_debit' => $validatedData['crj_deposit_debit'],
            'crj_deposit_credit' => $validatedData['crj_deposit_credit'],
            'crj_accountcode' => $validatedData['crj_accountcode'],
            'crj_debit' => $validatedData['crj_debit'],
            'crj_credit' => $validatedData['crj_credit']
        ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
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

    // Soft delete GeneralJournal
    public function softDeleteCashReceiptJournal($cash_receipt_journal_id)
    {
        $cash_receipt_journal= CashReceiptJournalModel::find($cash_receipt_journal_id);
        if ( $cash_receipt_journal) {
            $cash_receipt_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->crj_entrynum_date = '';
        $this->crj_jevnum = '';
        $this->crj_payor = '';
        $this->crj_collection_debit = '';
        $this->crj_collection_credit = '';
        $this->crj_deposit_debit = '';
        $this->crj_deposit_credit = '';
        $this->crj_accountcode = '';
        $this->crj_debit = '';
        $this->crj_credit = '';
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
    public function restoreCashReceiptJournal($id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::onlyTrashed()->find($id);
        if ($cash_receipt_journal) {
            $cash_receipt_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
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

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $this->totalCollectionDebit = $query->sum('crj_collection_debit');
        $this->totalCollectionCredit = $query->sum('crj_collection_credit');
        $this->totalDepositDebit = $query->sum('crj_deposit_debit');
        $this->totalDepositCredit = $query->sum('crj_deposit_credit');
        $this->totalDebit = $query->sum('crj_debit');
        $this->totalCredit = $query->sum('crj_credit');

        // Get paginated results
        $cash_receipt_journal = $query->paginate(10);

        return view('livewire.cash-receipt-journal-show',['cash_receipt_journal' => $cash_receipt_journal]);
    }
}