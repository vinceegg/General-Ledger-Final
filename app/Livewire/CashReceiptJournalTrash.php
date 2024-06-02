<?php

namespace App\Livewire;

use App\Models\CashReceiptJournalModel;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CashReceiptJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $crj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $cashreceiptjournal_no;
    public $crj_jevnum;
    public $softDeletedData;
    public $file;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message


    //@korinlv: added this function
    public function mount()
    {
        $this->softDeletedData = CashReceiptJournalModel::onlyTrashed()
            ->with(['crj_sundry_data' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
    }

    //@korinlv: edited this function
    public function restoreCashReceiptJournal($cashreceiptjournal_no)
    {
        $cashreceiptjournal_no = CashReceiptJournalModel::onlyTrashed()->find($cashreceiptjournal_no);
        if ($cashreceiptjournal_no) {
            // Load trashed sundries
            $trashedSundries = $cashreceiptjournal_no->crj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $cashreceiptjournal_no->restore();
            return redirect()->route('CashReceiptJournalArchived')->with('message', 'Restored Successfully');
        }
    }

    public function deleteCashReceiptJournal($cashreceiptjournal_no, $type = 'soft')
    {
        $this->cashreceiptjournal_no = $cashreceiptjournal_no;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashReceiptJournal()
    {
        $cashreceiptjournal_no = CashReceiptJournalModel::withTrashed()->find($this->cashreceiptjournal_no);
        if ($this->deleteType == 'force') {
            $cashreceiptjournal_no->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cashreceiptjournal_no->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashReceiptJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->cashreceiptjournal_no = '';
    }

    public function render()
    {
        return view('livewire.cash-receipt-journal-trash');
    }
}
