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
    public $generaljournal_no;
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
    public function restoreGeneralJournal($generaljournal_no)
    {
        $general_journal = GeneralJournalModel::onlyTrashed()->find($generaljournal_no);
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

    public function deleteGeneralJournal($generaljournal_no, $type = 'soft')
    {
        $this->generaljournal_no = $generaljournal_no;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyGeneralJournal()
    {
        $generaljournal_no = GeneralJournalModel::withTrashed()->find($this->generaljournal_no);
        if ($this->deleteType == 'force') {
            $generaljournal_no->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $generaljournal_no->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('GeneralJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->generaljournal_no = '';
    }

    public function render()
    {
        return view('livewire.general-journal-trash');
    }
}
