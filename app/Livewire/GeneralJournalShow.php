<?php

namespace App\Livewire;

use App\Exports\GeneralJournalExport;
use App\Imports\GeneralJournalImport;
use Livewire\WithPagination;
use App\Models\GeneralJournalModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;


class GeneralJournalShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $gj_entrynum,
    $gj_entrynum_date,
    $gj_jevnum,
    $gj_particulars,
    $gj_accountcode,
    $gj_debit,
    $gj_credit,
    $general_journal_col;

    public $search;
    public $general_journal_id; // Add this property
    public $selectedMonth;
    public $sortField = 'gj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;

    // Validation rules
    protected function rules()
    {
        return [
            'gj_entrynum' => 'required|integer',
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|integer',
            'gj_particulars' => 'required|string',
            'gj_accountcode' => 'required|string',
            'gj_debit' => 'nullable|numeric',
            'gj_credit' => 'nullable|numeric',
            'general_journal_col' => 'nullable|string',
        ];
    }

    // Validate when fields are updated
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    // Save new GeneralJournal
    public function saveGeneralJournal()
    {
        $validatedData = $this->validate();
        // $validatedData['gj_debit'] = $validatedData['gj_debit'] ?? null;

        GeneralJournalModel::create($validatedData);
        session()->flash('message', 'Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Edit GeneralJournal
    public function editGeneralJournal($general_journal_id)
    {
        $generaljournal = GeneralJournalModel::find($general_journal_id);
        if ($generaljournal) {
            $this->general_journal_id = $generaljournal->id;
            $this->gj_entrynum = $generaljournal->gj_entrynum;
            $this->gj_entrynum_date = $generaljournal->gj_entrynum_date;
            $this->gj_jevnum = $generaljournal->gj_jevnum;
            $this->gj_particulars = $generaljournal->gj_particulars;
            $this->gj_accountcode = $generaljournal->gj_accountcode;
            $this->gj_debit = $generaljournal->gj_debit;
            $this->gj_credit = $generaljournal->gj_credit;
            $this->general_journal_col = $generaljournal->general_journal_col;
        }
        else {
            return redirect() -> to('/general_journal'); 
        }
    }

    // Update GeneralJournal
    public function updateGeneralJournal()
    {
        $validatedData = $this->validate();

        GeneralJournalModel::where('id', $this->general_journal_id)->update([
            'gj_entrynum' => $validatedData['gj_entrynum'],
            'gj_entrynum_date' => $validatedData['gj_entrynum_date'],
            'gj_jevnum' => $validatedData['gj_jevnum'],
            'gj_particulars' => $validatedData['gj_particulars'],
            'gj_accountcode' => $validatedData['gj_accountcode'],
            'gj_debit' => $validatedData['gj_debit'],
            'gj_credit' => $validatedData['gj_credit'],
            'general_journal_col' => $validatedData['general_journal_col'],
         ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Delete GeneralJournal
    public function deleteGeneralJournal(int $general_journal_id)
    {
        $this->general_journal_id = $general_journal_id;
    }

    // Destroy GeneralJournal
    public function destroyGeneralJournal()
    {
        GeneralJournalModel::find($this->general_journal_id)->delete();
        session()->flash('message', 'Deleted Successfully');
        $this->dispatch('close-modal');
    }

    // Close modal and reset input
    public function closeModal()
    {
        $this->resetInput();
    }

    // Reset input values
    public function resetInput()
    {
        $this->gj_entrynum = '';
        $this->gj_entrynum_date = '';
        $this->gj_jevnum = '';
        $this->gj_particulars = '';
        $this->gj_accountcode = '';
        $this->gj_debit = '';
        $this->gj_credit = '';
        $this->general_journal_col = '';
    }

    // Soft delete GeneralJournal
    public function softDeleteGeneralJournal($general_journal_id)
    {
        $general_journal= GeneralJournalModel::find($general_journal_id);
        if ( $general_journal) {
            $general_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
    
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //PATI TO
    // View soft deleted GeneralJournals
    public function trashedGeneralJournal()
    {
        $this->softDeletedData = GeneralJournalModel::onlyTrashed()->get();
        return view('livewire.g-j-trashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function GoToGeneralJournalTrashed()
    {
        return redirect()->route('general-journal.trashedGeneralJournal');
    }

    //DI PA TO NAAPPLY SA LAHAT NG JOURNAL
    //AYAW PA GUMANA
    public function restoreGeneralJournal($general_journal_id)
    {
        GeneralJournalModel::where($general_journal_id)->restore();
        session()->flash('message', 'Restored Successfully');
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

    public function importGJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new GeneralJournalImport, $filePath);

        return redirect()->back();
        }
    }
    
    public function importViewGJ(){
        return view('journals.GJ');
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportGJ(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.xlsx');
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

    //ITO NAMAN SA IMPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    

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
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        // Get paginated results
        $general_journal = $query->orderBy('id', 'ASC')->paginate(10);

        //IBA DITO SA CODE NG CRJ
        //$cash_receipt_journal = $query->paginate(10);

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}