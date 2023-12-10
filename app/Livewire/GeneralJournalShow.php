<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\GeneralJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use App\Exports\GeneralJournalExport;
use Maatwebsite\Excel\Facades\Excel;

class GeneralJournalShow extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    // Declare public properties
    public $entrynumber, $date, $jevnumber, $particulars, $accountcode, $debit, $credit, $Journalcol;
    public $search = '';
    public $general_journal_id; // Add this property
    public $selectedMonth;
    public $sortField = 'date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'desc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;

    // Validation rules
    protected function rules()
    {
        return [
            'entrynumber' => 'nullable|integer',
            'date' => 'nullable|date',
            'jevnumber' => 'nullable|integer',
            'particulars' => 'required|string',
            'accountcode' => 'required|string',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
            'Journalcol' => 'nullable|string',
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

        $validatedData['debit'] = $validatedData['debit'] ?? null;

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
            $this->entrynumber = $generaljournal->entrynumber;
            $this->date = $generaljournal->date;
            $this->particulars = $generaljournal->particulars;
            $this->accountcode = $generaljournal->accountcode;
            $this->debit = $generaljournal->debit;
            $this->credit = $generaljournal->credit;
            $this->Journalcol = $generaljournal->Journalcol;
            $this->dispatch('open-modal');
        }
    }

    // Update GeneralJournal
    public function updateGeneralJournal()
    {
        $validatedData = $this->validate();

        GeneralJournalModel::where('id', $this->general_journal_id)->update($validatedData);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Delete GeneralJournal
    public function deleteGeneralJournal($general_journal_id)
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

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralJournal
    public function softDelete($general_journal_id)
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
    public function trashed()
    {
    $this->softDeletedData = GeneralJournalModel::onlyTrashed()->get();
    return view('livewire.gjtrashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function restore($general_journal_id)
    {
        GeneralJournalModel::where($general_journal_id)->restore();
        session()->flash('message', 'Restored Successfully');
    }

    // public function restore($id){

    //     Article::whereId($id)->restore();
        
    //     return back();

    // }
    

    // Close modal and reset input
    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    // Reset input values
    public function resetInput()
    {
        $this->entrynumber = '';
        $this->date = '';
        $this->jevnumber = '';
        $this->particulars = '';
        $this->accountcode = '';
        $this->debit = '';
        $this->credit = '';
        $this->Journalcol = '';
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
    
    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function export() 
    {
        return Excel::download(new GeneralJournalExport, 'generaljournal.xlsx');
    }

    // Render the component
    public function render()
    {
        $query = GeneralJournalModel::query();

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
        $general_journal = $query->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}