<?php

namespace App\Livewire;

use App\Exports\CheckDisbursementJournalExport;
use App\Imports\CheckDisbursementJournalImport;
use Livewire\WithPagination;
use App\Models\CheckDisbursementJournalModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CheckDisbursementJournalShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $ckdj_entrynum_date,
    $ckdj_checknum,
    $ckdj_payee,
    $ckdj_bur,
    $ckdj_cib_lcca,
    $ckdj_account1,
    $ckdj_account2,
    $ckdj_account3,
    $ckdj_salary_wages,
    $ckdj_honoraria,
    $ckdj_sundry_accountcode,
    $ckdj_debit,
    $ckdj_credit,
    $deleteType; // Added deleteType property

    public $search;
    public $check_disbursement_journal_id;
    public $selectedMonth;
    public $sortField = 'ckdj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;
    public $file;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCib = 0;
    public $totalAccount1 = 0;
    public $totalAccount2 = 0;
    public $totalAccount3 = 0;
    public $totalSalaryWages = 0;
    public $totalHonoraria = 0;
    public $totalAccountCode = 0;
    public $viewDeleted = false; // Property to toggle deleted records view

    protected function rules()
    {
        return [

            'ckdj_entrynum'=>'required|integer',
            'ckdj_entrynum_date'=>'nullable|date',
            'ckdj_checknum'=>'nullable|integer',
            'ckdj_payee'=>'nullable|string',
            'ckdj_bur'=>'nullable|integer',
            'ckdj_cib_lcca'=> 'nullable|numeric',
            'ckdj_account1'=> 'nullable|numeric',
            'ckdj_account2'=> 'nullable|numeric',
            'ckdj_account3'=> 'nullable|numeric',
            'ckdj_salary_wages'=> 'nullable|numeric',
            'ckdj_honoraria'=> 'nullable|numeric',
            'ckdj_sundry_accountcode'=>'nullable|string',
            'ckdj_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ckdj_credit'=> 'nullable|numeric|min:0|max:100000000',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCheckDisbursementJournal()
    {
        $validatedData = $this->validate();

        CheckDisbursementJournalModel::create($validatedData);
        session()->flash('message', 'Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::find($check_disbursement_journal_id);
        if ($check_disbursement_journal) {

            $this->check_disbursement_journal_id = $check_disbursement_journal->id;
            $this->ckdj_entrynum_date = $check_disbursement_journal->ckdj_entrynum_date;
            $this->ckdj_checknum = $check_disbursement_journal->ckdj_checknum;
            $this->ckdj_payee = $check_disbursement_journal->ckdj_payee;
            $this->ckdj_bur = $check_disbursement_journal->ckdj_bur;
            $this->ckdj_cib_lcca = $check_disbursement_journal->ckdj_cib_lcca;
            $this->ckdj_account1 = $check_disbursement_journal->ckdj_account1;
            $this->ckdj_account2 = $check_disbursement_journal->ckdj_account2;
            $this->ckdj_account3 = $check_disbursement_journal->ckdj_account3;
            $this->ckdj_salary_wages = $check_disbursement_journal->ckdj_salary_wages;
            $this->ckdj_honoraria = $check_disbursement_journal->ckdj_honoraria;
            $this->ckdj_sundry_accountcode = $check_disbursement_journal->ckdj_sundry_accountcode;
            $this->ckdj_debit = $check_disbursement_journal->ckdj_debit;
            $this->ckdj_credit = $check_disbursement_journal->ckdj_credit;
        } 
        else {
            return redirect() -> to('/check_disbursement_journal'); 
        }
    }

    public function updateCheckDisbursementJournal()
    {
        $validatedData = $this->validate();

        CheckDisbursementJournalModel::where('id', $this->check_disbursement_journal_id)->update([
            'ckdj_entrynum_date' => $validatedData['ckdj_entrynum_date'],
            'ckdj_checknum' => $validatedData['ckdj_checknum'],
            'ckdj_payee' => $validatedData['ckdj_payee'],
            'ckdj_bur' => $validatedData['ckdj_bur'],
            'ckdj_cib_lcca' => $validatedData['ckdj_cib_lcca'],
            'ckdj_account1' => $validatedData['ckdj_account1'],
            'ckdj_account2' => $validatedData['ckdj_account2'],
            'ckdj_account3' => $validatedData['ckdj_account3'],
            'ckdj_salary_wages' => $validatedData['ckdj_salary_wages'],
            'ckdj_honoraria' => $validatedData['ckdj_honoraria'],
            'ckdj_sundry_accountcode' => $validatedData['ckdj_sundry_accountcode'],
            'ckdj_debit' => $validatedData['ckdj_debit'],
            'ckdj_credit' => $validatedData['ckdj_credit'],
        ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Delete CheckDisbursementJournal
    public function deleteCheckDisbursementJournal(int $check_disbursement_journal_id, $type = 'soft')
    {
        $this->check_disbursement_journal_id = $check_disbursement_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCheckDisbursementJournal()
    {
        $check_disbursement_journal_id = CheckDisbursementJournalModel::withTrashed()->find($this->check_disbursement_journal_id);
        if ($this->deleteType == 'force') {
            $check_disbursement_journal_id->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $check_disbursement_journal_id->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput()
    {
        $this->check_disbursement_journal_id = '';
        $this->ckdj_entrynum_date = '';            
        $this->ckdj_checknum = '';        
        $this->ckdj_payee = '';
        $this->ckdj_bur = '';
        $this->ckdj_cib_lcca = '';
        $this->ckdj_account1 = '';
        $this->ckdj_account2 = '';
        $this->ckdj_account3 = '';
        $this->ckdj_salary_wages = '';
        $this->ckdj_honoraria = '';
        $this->ckdj_sundry_accountcode = '';
        $this->ckdj_debit = '';
        $this->ckdj_credit = '';

    }

    // Soft delete CheckDisbursementJournal
    public function softDeleteCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $check_disbursement_journal= CheckDisbursementJournalModel::find($check_disbursement_journal_id);
        if ( $check_disbursement_journal) {
            $check_disbursement_journal->delete();
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

    public function importCKDJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CheckDisbursementJournalImport, $filePath);

        return redirect()->back();
        }
    }

    public function importViewCKDJ(){
        return view('journals.CKDJ');
    }
    
    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportCKDJ_XLSX(Request $request) 
    {
        return Excel::download(new CheckDisbursementJournalExport, 'CKDJ.xlsx');
    }
    // @korin: edited this function
    public function exportCKDJ_CSV(Request $request) 
    {
        return Excel::download(new CheckDisbursementJournalExport, 'CKDJ.csv');
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
    public function restoreCheckDisbursementJournal($id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::onlyTrashed()->find($id);
        if ($check_disbursement_journal) {
            $check_disbursement_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    // Render the component
    public function render()
    {
        $query = CheckDisbursementJournalModel::query();

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }
    
        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
    
            $query->whereBetween('ckdj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }
    
        // Add the search filter
        // $query->where('id', 'like', '%' . $this->search . '%');

        // @korin: edited this function

        $query->where(function ($q) {
            $q->where('id', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_checknum', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_payee', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_bur', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_cib_lcca', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account1', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account2', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account3', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_salary_wages', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_honoraria', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_sundry_accountcode', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_debit', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_credit', 'like', '%' . $this->search . '%');
        });
    
        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        // $this->totalDebit = $query->sum('ckdj_sundry_debit');
        // $this->totalCredit = $query->sum('ckdj_sundry_credit');
        $this->totalCib = $query->sum('ckdj_cib_lcca');
        $this->totalAccount1 = $query->sum('ckdj_account1');
        $this->totalAccount2 = $query->sum('ckdj_account2');
        $this->totalAccount3 = $query->sum('ckdj_account3');
        $this->totalSalaryWages = $query->sum('ckdj_salary_wages');
        $this->totalHonoraria = $query->sum('ckdj_honoraria');
        $this->totalAccountCode = $query->sum('ckdj_sundry_accountcode');

        // Get paginated results with eager loading of 'sundries' relationship
        $check_disbursement_journal = $query->paginate(10);
    
        return view('livewire.check-disbursement-journal-show', ['check_disbursement_journal' => $check_disbursement_journal]);
    }
}