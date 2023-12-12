<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\CashDisbursementJournalExport;
use App\Imports\CashDisbursementJournalImport;
use Maatwebsite\Excel\Facades\Excel;

class CashDisbursementJournalShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $cdj_entrynum,
    $cdj_entrynum_date,
    $cdj_referencenum,
    $cdj_accountable_officer,
    $cdj_jevnum,
    $cdj_accountcode,
    $cdj_amount,
    $cdj_account1,
    $cdj_account2,
    $cdj_sundry_accountcode,
    $cdj_pr,
    $cdj_debit,
    $cdj_credit;

    public $search='';
    public $cash_disbursement_journal_id;

    public $selectedMonth;
    public $sortField = 'cdj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'desc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;
    public $file;

    protected function rules()
    {
        return [

            'cdj_entrynum'=>'required|integer',
            'cdj_entrynum_date'=>'nullable|date',
            'cdj_referencenum'=>'nullable|string',
            'cdj_accountable_officer'=>'nullable|string',
            'cdj_jevnum'=>'nullable|integer',
            'cdj_accountcode'=>'nullable|integer',
            'cdj_amount'=> 'nullable|numeric',
            'cdj_account1'=> 'nullable|numeric',
            'cdj_account2'=> 'nullable|numeric',
            'cdj_sundry_accountcode'=>'nullable|string',
            'cdj_pr'=>'nullable|string',
            'cdj_debit'=> 'nullable|numeric',
            'cdj_credit'=> 'nullable|numeric',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCashDisbursementJournal()
    {
        $validatedData = $this->validate();

        CashDisbursementJournalModel::create($validatedData);
        session()->flash('message', 'Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editCashDisbursementJournal($cash_disbursement_journal_id)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::find($cash_disbursement_journal_id);
        if ($cash_disbursement_journal) {

            $this->cash_disbursement_journal_id = $cash_disbursement_journal->id;
            $this->cdj_entrynum = $cash_disbursement_journal->cdj_entrynum;
            $this->cdj_entrynum_date = $cash_disbursement_journal->cdj_entrynum_date;
            $this->cdj_referencenum = $cash_disbursement_journal->cdj_referencenum;
            $this->cdj_accountable_officer = $cash_disbursement_journal->cdj_accountable_officer;
            $this->cdj_jevnum = $cash_disbursement_journal->cdj_jevnum;
            $this->cdj_accountcode = $cash_disbursement_journal->cdj_accountcode;
            $this->cdj_amount = $cash_disbursement_journal->cdj_amount;
            $this->cdj_account1 = $cash_disbursement_journal->cdj_account1;
            $this->cdj_account2 = $cash_disbursement_journal->cdj_account2;
            $this->cdj_sundry_accountcode = $cash_disbursement_journal->cdj_sundry_accountcode;
            $this->cdj_pr = $cash_disbursement_journal->cdj_pr;
            $this->cdj_debit = $cash_disbursement_journal->cdj_debit;
            $this->cdj_credit = $cash_disbursement_journal->cdj_credit;
            $this->dispatch('open-modal');
        }
    }

    public function updateCashDisbursementJournal()
    {
        $validatedData = $this->validate();

        CashDisbursementJournalModel::where('id', $this->cash_disbursement_journal_id)->update($validatedData);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCashDisbursementJournal($cash_disbursement_journal_id)
    {
        $this->cash_disbursement_journal_id = $cash_disbursement_journal_id;
    }

    public function destroyCashDisbursementJournal()
    {
        CashDisbursementJournalModel::find($this->cash_disbursement_journal_id)->delete();
        session()->flash('message', 'Deleted Successfully');
        $this->dispatch('close-modal');
    }

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralJournal
    public function softDeleteCashDisbursementJournal($cash_disbursement_journal_id)
    {
        $cash_disbursement_journal= CashDisbursementJournalModel::find($cash_disbursement_journal_id);
        if ( $cash_disbursement_journal) {
            $cash_disbursement_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
    
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //PATI TO
    // View soft deleted GeneralJournals
    public function trashedCashDisbursementJournal()
    {
        $this->softDeletedData = CashDisbursementJournalModel::onlyTrashed()->get();
        return view('livewire.c-d-j-trashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function restoreCheckDisbursementJournal($cash_disbursement_journal_id)
    {
        CashDisbursementJournalModel::where($cash_disbursement_journal_id)->restore();
        session()->flash('message', 'Restored Successfully');
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput()
    {
            $this->cash_disbursement_journal_id = '';
            $this->cdj_entrynum = '';
            $this->cdj_entrynum_date = '';
            $this->cdj_referencenum = '';
            $this->cdj_accountable_officer = '';
            $this->cdj_jevnum = '';
            $this->cdj_accountcode ='';
            $this->cdj_amount = '';
            $this->cdj_account1 = '';
            $this->cdj_account2 = '';
            $this->cdj_sundry_accountcode = '';
            $this->cdj_pr = '';
            $this->cdj_debit = '';
            $this->cdj_credit = '';
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

    public function importViewCDJ(){
        return view('journals.CDJ');
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportCDJ() 
    {
        return Excel::download(new CashDisbursementJournalExport, 'Cash Disbursement Journal.xlsx');
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

    public function GoToCashDisbursementJournalTrashed()
    {
        return redirect()->route('cash-disbursement-journal.trashedCashDisbursementJournal');
    }

    public function render()
    {
        $query = CashDisbursementJournalModel::query();

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
        $cash_disbursement_journal = $query->paginate(10);
        return view('livewire.cash-disbursement-journal-show',['cash_disbursement_journal' => $cash_disbursement_journal]);
    }
}