<?php

namespace App\Livewire;

use App\Models\CheckDisbursementJournalModel;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CheckDisbursementJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $ckdj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $ckdj_checknum;
    public $checkdisbursementjournal_no;
    public $softDeletedData;
    public $file;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message


    //@korinlv: added this function
    public function mount()
    {
        $this->softDeletedData = CheckDisbursementJournalModel::onlyTrashed()
            ->with(['ckdj_sundry_data' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
    }

    //@korinlv: edited this function
    public function restoreCheckDisbursementJournal($checkdisbursementjournal_no)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::onlyTrashed()->find($checkdisbursementjournal_no);
        if ($check_disbursement_journal) {
            // Load trashed sundries
            $trashedSundries = $check_disbursement_journal->ckdj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $check_disbursement_journal->restore();
            return redirect()->route('CheckDisbursementJournalArchived')->with('message', 'Restored Successfully');
        }
    }

    public function deleteCheckDisbursementJournal($checkdisbursementjournal_no, $type = 'soft')
    {
        $this->checkdisbursementjournal_no = $checkdisbursementjournal_no;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCheckDisbursementJournal()
    {
        $checkdisbursementjournal_no = CheckDisbursementJournalModel::withTrashed()->find($this->checkdisbursementjournal_no);
        if ($this->deleteType == 'force') {
            $checkdisbursementjournal_no->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $checkdisbursementjournal_no->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CheckDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->checkdisbursementjournal_no = '';
    }

    public function render()
    {
        return view('livewire.check-disbursement-journal-trash');
    }
}




