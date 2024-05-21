<?php

namespace App\Livewire;

use App\Models\CheckDisbursementJournalModel;
use Livewire\Component;
use App\Exports\CheckDisbursementJournalExport;
use App\Imports\CheckDisbursementJournalImport;
use App\Models\CKDJ_SundryModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CheckDisbursementJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $ckdj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $check_disbursement_journal_id;
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
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CheckDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> check_disbursement_journal_id = '';
    }
}





