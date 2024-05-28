<?php

namespace App\Livewire;

use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CashDisbursementJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $cdj_sundry_data = [], //@korinlv: added this
    $deleteType;

    public $search;
    public $cdj_jevnum;
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
    public function restoreCashDisbursementJournal($cdj_jevnum)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::onlyTrashed()->find($cdj_jevnum);
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

    public function deleteCashDisbursementJournal(string $cdj_jevnum, $type = 'soft')
    {
        $this->cdj_jevnum = $cdj_jevnum;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashDisbursementJournal()
    {
        $cdj_jevnum = CashDisbursementJournalModel::withTrashed()->find($this->cdj_jevnum);
        if ($this->deleteType == 'force') {
            $cdj_jevnum->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cdj_jevnum->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> cdj_jevnum = '';
    }

    public function render()
    {
        return view('livewire.cash-disbursement-journal-trash');
    }
}
