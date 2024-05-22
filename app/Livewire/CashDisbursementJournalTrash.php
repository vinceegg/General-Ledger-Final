<?php

namespace App\Livewire;

use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use App\Exports\CashDisbursementJournalExport;
use App\Imports\CashDisbursementJournalImport;
use App\Models\CDJ_SundryModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CashDisbursementJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $cdj_sundry_data = [], //@korinlv: added this
    $deleteType;
// Added deleteType property

    public $search;
    public $cash_disbursement_journal_id;
    public $softDeletedData;
    public $file;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message


    //@korinlv: added this function
    public function mount()
    {
        $this->softDeletedData = CashDisbursementJournalModel::onlyTrashed()
            ->with(['cdj_sundry_data' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
    }

    //@korinlv: edited this function
    public function restoreCashDisbursementJournal($id)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::onlyTrashed()->find($id);
        if ($cash_disbursement_journal) {
            // Load trashed sundries
            $trashedSundries = $cash_disbursement_journal->cdj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $cash_disbursement_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    public function deleteCashDisbursementJournal(int $cash_disbursement_journal_id, $type = 'soft')
    {
        $this->cash_disbursement_journal_id = $cash_disbursement_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashDisbursementJournal()
    {
        $cash_disbursement_journal_id = CashDisbursementJournalModel::withTrashed()->find($this->cash_disbursement_journal_id);
        if ($this->deleteType == 'force') {
            $cash_disbursement_journal_id->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cash_disbursement_journal_id->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> cash_disbursement_journal_id = '';
    }
}
