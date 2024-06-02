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
    public $cashdisbursementjournal_no;
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
    public function restoreCashDisbursementJournal($cashdisbursementjournal_no)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::onlyTrashed()->find($cashdisbursementjournal_no);
        if ($cash_disbursement_journal) {
            // Load trashed sundries
            $trashedSundries = $cash_disbursement_journal->cdj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $cash_disbursement_journal->restore();
            return redirect()->route('CashDisbursementJournalArchived')->with('message', 'Restored Successfully');
        }
    }

    public function deleteCashDisbursementJournal($cashdisbursementjournal_no, $type = 'soft')
    {
        $this->cashdisbursementjournal_no = $cashdisbursementjournal_no;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashDisbursementJournal()
    {
        $cashdisbursementjournal_no = CashDisbursementJournalModel::withTrashed()->find($this->cashdisbursementjournal_no);
        if ($this->deleteType == 'force') {
            $cashdisbursementjournal_no->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cashdisbursementjournal_no->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashDisbursementJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> cashdisbursementjournal_no = '';
    }

    public function render()
    {
        return view('livewire.cash-disbursement-journal-trash');
    }
}
