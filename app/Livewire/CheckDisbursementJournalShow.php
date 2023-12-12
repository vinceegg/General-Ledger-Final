<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\CheckDisbursementJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\CheckDisbursementJournalExport;
use App\Imports\CheckDisbursementJournalImport;
use App\Models\CKDJSundryModel;
use Maatwebsite\Excel\Facades\Excel;


class CheckDisbursementJournalShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ckdj_entrynum,
    $ckdj_entrynum_date,
    $ckdj_checknum,
    $ckdj_payee,
    $ckdj_bur,
    $ckdj_cib_lcca,
    $ckdj_account1,
    $ckdj_account2,
    $ckdj_account3,
    $ckdj_salary_wages,
    $ckdj_honoraria;

    public $search='';
    public $check_disbursement_journal_id;
    public $ckdj_sundry_id;

    public $selectedMonth;
    public $sortField = 'ckdj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'desc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;
    public $file;




//STEP 1

    public $ckdj_sundry_account_code, $ckdj_sundry_debit, $ckdj_sundry_credit;
    public $inputs = [];
    

    public function add()
    {
        $this->inputs[] = [
            'ckdj_sundry_account_code' => $this->ckdj_sundry_account_code,
            'ckdj_sundry_debit' => $this->ckdj_sundry_debit,
            'ckdj_sundry_credit' => $this->ckdj_sundry_credit,
        ];

        // Clear input fields
        $this->ckdj_sundry_account_code = '';
        $this->ckdj_sundry_debit = '';
        $this->ckdj_sundry_credit = '';
    }

    public function remove($key)
    {
        unset($this->inputs[$key]);
    }

    public function store()
    {
        foreach ($this->inputs as $input) {
            CKDJSundryModel::create([
                'ckdj_sundry_account_code' => $input['ckdj_sundry_account_code'],
                'ckdj_sundry_debit' => $input['ckdj_sundry_debit'],
                'ckdj_sundry_credit' => $input['ckdj_sundry_credit'],
            ]);
        }

        // Reset inputs
        $this->inputs = [];

        // Clear input fields
        $this->ckdj_sundry_account_code = '';
        $this->ckdj_sundry_debit = '';
        $this->ckdj_sundry_credit = '';

        session()->flash('message', 'Employee data has been saved successfully.');
    }







    public function editCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::find($check_disbursement_journal_id);
        if ($check_disbursement_journal) {

            $this->check_disbursement_journal_id = $check_disbursement_journal->id;
            $this->ckdj_entrynum = $check_disbursement_journal->ckdj_entrynum;
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
            $this->ckdj_sundry_account_code = $check_disbursement_journal->ckdj_sundry_account_code;
            $this->ckdj_sundry_debit = $check_disbursement_journal->ckdj_sundry_debit;
            $this->ckdj_sundry_credit = $check_disbursement_journal->ckdj_sundry_credit;

        }
    }
            
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
            'ckdj_sundry_account_code'=>'nullable|string',
            'ckdj_sundry_debit'=> 'nullable|numeric',
            'ckdj_sundry_credit'=> 'nullable|numeric'
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

    

    public function updateCheckDisbursementJournal()
    {
        $validatedData = $this->validate();

        CheckDisbursementJournalModel::where('id', $this->check_disbursement_journal_id)->update($validatedData);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $this->check_disbursement_journal_id = $check_disbursement_journal_id;
    }

    public function destroyCheckDisbursementJournal()
    {
        CheckDisbursementJournalModel::find($this->check_disbursement_journal_id)->delete();
        session()->flash('message', 'Deleted Successfully');
        $this->dispatch('close-modal');
    }

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralJournal
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

    //PATI TO
    // View soft deleted GeneralJournals
    public function trashedCheckDisbursementJournal()
    {
        $this->softDeletedData = CheckDisbursementJournalModel::onlyTrashed()->get();
        return view('livewire.ckdj-trashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function restoreCheckDisbursementJournal($check_disbursement_journal_id)
    {
        CheckDisbursementJournalModel::where($check_disbursement_journal_id)->restore();
        session()->flash('message', 'Restored Successfully');
    }


    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput()
    {
        $this->check_disbursement_journal_id = '';
        $this->ckdj_entrynum = '';
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
        $this->ckdj_sundry_account_code = '';
        $this->ckdj_sundry_debit = '';
        $this->ckdj_sundry_credit = '';

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

    public function importViewCKDJ(){
        return view('journals.CKDJ');
    }
    
    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportCKDJ() 
    {
        return Excel::download(new CheckDisbursementJournalExport, 'generaljournal.xlsx');
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

    public function GoToCheckDisbursementJournalTrashed()
    {
        return redirect()->route('check-disbursement-journal.trashedCheckDisbursementJournal');
    }
    // Render the component
    public function render()
    {
        $query = CheckDisbursementJournalModel::query();
    
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

        // Get paginated results with eager loading of 'sundries' relationship
        $query->with('sundries')->orderBy($this->sortField, $this->sortDirection)->paginate(10);

    
        return view('livewire.check-disbursement-journal-show', ['check_disbursement_journal' => $query->paginate(10)]);
    }
    
}