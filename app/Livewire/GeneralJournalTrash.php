<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeneralJournalModel;

class GeneralJournalTrash extends Component
{
    public 
    $gj_accountcodes_data = []; //@korinlv: added this

    public $general_journal_id;
    public $deleteType;
    public $softDeletedData;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
  

    public function mount()
    {
        $this->softDeletedData = GeneralJournalModel::onlyTrashed()
        ->with(['gj_accountcodes_data' => function ($query) {
            $query->withTrashed();
        }])
        ->get();    
    }

    // Method to restore soft-deleted record
    public function restoreGeneralJournal($id)
    {
        $general_journal = GeneralJournalModel::onlyTrashed()->find($id);
        if ($general_journal) {
            $general_journal->restore();
            session()->flash('message', 'Record restored successfully.');
            $this->softDeletedData = GeneralJournalModel::onlyTrashed()->get();
        }
    }

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
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('GeneralJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->general_journal_id = '';
    }
}