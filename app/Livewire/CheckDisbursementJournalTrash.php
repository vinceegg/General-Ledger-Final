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
    public function restoreCheckDisbursementJournal($ckdj_checknum)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::onlyTrashed()->find($ckdj_checknum);
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

    public function deleteCheckDisbursementJournal(string $ckdj_checknum, $type = 'soft')
    {
        $this->ckdj_checknum = $ckdj_checknum;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCheckDisbursementJournal()
    {
        $ckdj_checknum = CheckDisbursementJournalModel::withTrashed()->find($this->ckdj_checknum);
        if ($this->deleteType == 'force') {
            $ckdj_checknum->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $ckdj_checknum->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CheckDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> ckdj_checknum = '';
    }

    public function render()
    {
        return view('livewire.check-disbursement-journal-trash');
    }
}





