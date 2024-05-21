<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CheckDisbursementJournalModel;

class CheckDisbursementJournalTrash extends Component
{
    public $check_disbursement_journal_id;
    public $deleteType;
    public $softDeletedData;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    public $file;

    public function mount()
    {
        $this->softDeletedData = CheckDisbursementJournalModel::onlyTrashed()->get();
    }

     //@korinlv: edited this function
     public function restoreCheckDisbursementJournal($id)
     {
         $check_disbursement_journal = CheckDisbursementJournalModel::onlyTrashed()->find($id);
         if ($check_disbursement_journal) {
             // Load trashed sundries
             $trashedSundries = $check_disbursement_journal->ckdj_sundry_data()->onlyTrashed()->get();
             foreach ($trashedSundries as $sundry){
                 $sundry->restore();
             }
 
             $check_disbursement_journal->restore();
             session()->flash('message', 'Record restored successfully.');
         }
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
    }

    public function resetInput()
    {
        $this->check_disbursement_journal_id = '';
    }
}
