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

    public
    $gj_entrynum_date,
    $gj_jevnum,
    $gj_particulars,
    $gj_accountcode,
    $gj_debit,
    $gj_credit,
    $deleteType; // Added deleteType property

    public $search;
    public $general_journal_id; // Add this property
    public $selectedMonth;
    public $sortField = 'gj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $viewDeleted = false; // Property to toggle deleted records view

    // Validation rules
    protected function rules()
    {
        return [
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|integer',
            'gj_particulars' => 'required|string',
            'gj_accountcode' => 'required|string',
            'gj_debit' => 'nullable|numeric|min:0|max:100000000',
            'gj_credit' => 'nullable|numeric|min:0|max:100000000',
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
            $this->gj_entrynum_date = $generaljournal->gj_entrynum_date;
            $this->gj_jevnum = $generaljournal->gj_jevnum;
            $this->gj_particulars = $generaljournal->gj_particulars;
            $this->gj_accountcode = $generaljournal->gj_accountcode;
            $this->gj_debit = $generaljournal->gj_debit;
            $this->gj_credit = $generaljournal->gj_credit;
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
            'gj_entrynum_date' => $validatedData['gj_entrynum_date'],
            'gj_jevnum' => $validatedData['gj_jevnum'],
            'gj_particulars' => $validatedData['gj_particulars'],
            'gj_accountcode' => $validatedData['gj_accountcode'],
            'gj_debit' => $validatedData['gj_debit'],
            'gj_credit' => $validatedData['gj_credit'],
         ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Delete GeneralJournal
    public function deleteGeneralJournal(int $general_journal_id, $type = 'soft')
    {
        $this->general_journal_id = $general_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyGeneralJournal()
    {
        $general_journal = GeneralJournalModel::withTrashed()->find($this->general_journal_id);
        if ($this->deleteType == 'force') {
            $general_journal->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $general_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    // Close modal and reset input
    public function closeModal()
    {
        session()->forget('message');
        $this->resetInput();
    }

    // Reset input values
    public function resetInput()
    {
        $this->gj_entrynum_date = '';
        $this->gj_jevnum = '';
        $this->gj_particulars = '';
        $this->gj_accountcode = '';
        $this->gj_debit = '';
        $this->gj_credit = '';
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
    public function restoreGeneralJournal($id)
    {
        $general_journal = GeneralJournalModel::onlyTrashed()->find($id);
        if ($general_journal) {
            $general_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    // Render the component
    public function render()
    {
        $query = GeneralJournalModel::query();

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }

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

         // Compute the total debit and credit for the selected month
        $this->totalDebit = $query->sum('gj_debit');
        $this->totalCredit = $query->sum('gj_credit');

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}