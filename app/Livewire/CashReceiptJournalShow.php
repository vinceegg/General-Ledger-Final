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

    public $crj_entrynum,
    $crj_entrynum_date,
    $crj_jevnum,
    $crj_payor,
    $crj_collection_debit,
    $crj_collection_credit,
    $crj_deposit_debit,
    $crj_deposit_credit,
    $crj_accountcode,
    $crj_debit,
    $crj_credit;

    public $search='';
    public $cash_receipt_journal_id;
    public $selectedMonth;
    public $sortField = 'crj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'desc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;

    protected function rules()
    {
        return [

            'crj_entrynum' => 'nullable|integer',
            'crj_entrynum_date' => 'nullable|date',
            'crj_jevnum' => 'nullable|integer',
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric',
            'crj_collection_credit' => 'nullable|numeric',
            'crj_deposit_debit' => 'nullable|numeric',
            'crj_deposit_credit' => 'nullable|numeric',
            'crj_accountcode' => 'nullable|string',
            'crj_debit' => 'nullable|numeric',
            'crj_credit' => 'nullable|numeric'
        ];
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



    //PATI TO
    // View soft deleted GeneralJournals
    public function trashedCashReceiptJournal()
    {
        $this->softDeletedData = CashReceiptJournalModel::onlyTrashed()->get();
        return view('livewire.crj-trashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function restoreCashReceiptJournal($cash_receipt_journal_id)
    {
        CashReceiptJournalModel::where($cash_receipt_journal_id)->restore();
        session()->flash('message', 'Restored Successfully');
    }

    public function GoToCashReceiptJournalTrashed()
    {
        return redirect()->route('cash-receipt-journal.trashedCashReceiptJournal');
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
        $this->resetInput();
        $this->dispatch('close-modal');
    }

        public function editCashReceiptJournal($cash_receipt_journal_id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::find($cash_receipt_journal_id);
        if ($cash_receipt_journal) {
            $this->cash_receipt_journal_id = $cash_receipt_journal->id;
            $this->crj_entrynum = $cash_receipt_journal->crj_entrynum;
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
            $this->dispatch('open-modal');
        }
    }

    public function updateCashReceiptJournal()
    {
        $validatedData = $this->validate();

        CashReceiptJournalModel::where('id', $this->cash_receipt_journal_id)->update($validatedData);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCashReceiptJournal($cash_receipt_journal_id)
    {
        $this->cash_receipt_journal_id = $cash_receipt_journal_id;
    }

    public function destroyCashReceiptJournal()
    {
        CashReceiptJournalModel::find($this->cash_receipt_journal_id)->delete();
        session()->flash('message', 'Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }


    public function resetInput()
    {
        $this->crj_entrynum = '';
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


    
    public function importCRJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CashReceiptJournalImport, $filePath);

        return redirect()->back();
        }
    }

    // Sorting logic SA SORT TO KORINNE HA
    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'desc';
        }
    }
    

    public function importViewCRJ(){
        return view('journals.CRJ');
    }

    public function exportCRJ(Request $request){
        return Excel::download(new CashReceiptJournalExport, 'CRJ.xlsx');
    }


    public function render()
    {

        $query = CashReceiptJournalModel::query();

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        // Get paginated results
        $cash_receipt_journal = $query->paginate(10);



        return view('livewire.cash-receipt-journal-show',['cash_receipt_journal' => $cash_receipt_journal]);
    }
}