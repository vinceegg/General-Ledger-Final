<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeneralJournalModel;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GeneralJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $gj_accountcodes_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $gj_jevnum;
    public $softDeletedData;
    public $file;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

   //@korinlv: added this function
    public function mount()
    {
        $this->softDeletedData = GeneralJournalModel::onlyTrashed()
            ->with(['gj_accountcodes_data' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
    }

    //@korinlv: edited this function
    public function restoreGeneralJournal(string $gj_jevnum)
    {
        $general_journal = GeneralJournalModel::onlyTrashed()->find($gj_jevnum);
        if ($general_journal) {
            // Load trashed sundries
            $trashedSundries = $general_journal->gj_accountcodes_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }
            $general_journal->restore();
            return redirect()->route('GeneralJournalArchived')->with('message', 'Restored Successfully');
        }
    }

    public function deleteGeneralJournal(string $gj_jevnum, $type = 'soft')
    {
        $this->gj_jevnum = $gj_jevnum;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyGeneralJournal()
    {
        $gj_jevnum = GeneralJournalModel::withTrashed()->find($this->gj_jevnum);
        if ($this->deleteType == 'force') {
            $gj_jevnum->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $gj_jevnum->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('GeneralJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->gj_jevnum = '';
    }

    public function render()
    {
        return view('livewire.general-journal-trash');
    }
}