<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\CashDisbursementJournalExport;
use App\Imports\CashDisbursementJournalImport;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CashDisbursementJournalShow extends Component
{
    use WithPagination;
    use WithFileUploads;

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
    $cdj_credit,
    $deleteType; // Added deleteType property

    public $search;
    public $cash_disbursement_journal_id;
    public $selectedMonth;
    public $sortField = 'cdj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalAmount = 0;
    public $totalAccount1 = 0;
    public $totalAccount2 = 0;
    public $viewDeleted = false; // Property to toggle deleted records view

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
            'cdj_debit'=> 'nullable|numeric|min:0|max:100000000',            
            'cdj_credit'=> 'nullable|numeric|min:0|max:100000000',
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
        }
        else {
            return redirect() -> to('/cash_disbursement_journal'); 
        }
    }

    //NEW VERSION NG 'UPDATE' MAS MAHABA, WHY THO?
    public function updateCashDisbursementJournal()
    {
        $validatedData = $this->validate();

        CashDisbursementJournalModel::where('id', $this->cash_disbursement_journal_id)->update([
            'cdj_entrynum'=> $validatedData['cdj_entrynum'],
            'cdj_entrynum_date'=> $validatedData['cdj_entrynum_date'],
            'cdj_referencenum'=> $validatedData['cdj_referencenum'],
            'cdj_accountable_officer'=> $validatedData['cdj_accountable_officer'],
            'cdj_jevnum'=> $validatedData['cdj_jevnum'],
            'cdj_accountcode'=> $validatedData['cdj_accountcode'],
            'cdj_amount'=> $validatedData['cdj_amount'],
            'cdj_account1'=> $validatedData['cdj_account1'],
            'cdj_account2'=> $validatedData['cdj_account2'],
            'cdj_sundry_accountcode'=> $validatedData['cdj_sundry_accountcode'],
            'cdj_pr'=> $validatedData['cdj_pr'],
            'cdj_debit'=> $validatedData['cdj_debit'],            
            'cdj_credit'=> $validatedData['cdj_credit'],
        ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCashDisbursementJournal(int $cash_disbursement_journal_id, $type = 'soft')
    {
        $this->cash_disbursement_journal_id = $cash_disbursement_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyCashDisbursementJournal()
    {
        $cash_disbursement_journal_id = CashDisbursementJournalModel::withTrashed()->find($this->cash_disbursement_journal_id);
        if ($this->deleteType == 'force') {
            $cash_disbursement_journal_id->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cash_disbursement_journal_id->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
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

    public function importViewCDJ(){
        return view('journals.CDJ');
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

    // Method to toggle viewDeleted
    public function toggleDeletedView()
    {
        $this->viewDeleted = !$this->viewDeleted;
    }

    // Method to restore soft-deleted record
    public function restoreCashDisbursementJournal($id)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::onlyTrashed()->find($id);
        if ($cash_disbursement_journal) {
            $cash_disbursement_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }
    
    public function render()
    {
        $query = CashDisbursementJournalModel::query();

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('cdj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $this->totalAmount = $query->sum('cdj_amount');
        $this->totalAccount1 = $query->sum('cdj_account1');
        $this->totalAccount2 = $query->sum('cdj_account2');
        $this->totalDebit = $query->sum('cdj_debit');
        $this->totalCredit = $query->sum('cdj_credit');

        // Get paginated results
        $cash_disbursement_journal = $query->paginate(10);
        return view('livewire.cash-disbursement-journal-show',['cash_disbursement_journal' => $cash_disbursement_journal]);
    }
}