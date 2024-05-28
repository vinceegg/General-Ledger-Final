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
    public function restoreCashReceiptJournal(string $crj_jevnum)
    {
        $cash_receipt_journal = CashReceiptJournalModel::onlyTrashed()->find($crj_jevnum);
        if ($cash_receipt_journal) {
            // Load trashed sundries
            $trashedSundries = $cash_receipt_journal->crj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $cash_receipt_journal->restore();
            return redirect()->route('CashReceiptJournalArchived')->with('message', 'Restored Successfully');
        }
    }

    public function deleteCashReceiptJournal(string $crj_jevnum, $type = 'soft')
    {
        $this->crj_jevnum = $crj_jevnum;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashReceiptJournal()
    {
        $crj_jevnum = CashReceiptJournalModel::withTrashed()->find($this->crj_jevnum);
        if ($this->deleteType == 'force') {
            $crj_jevnum->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $crj_jevnum->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashReceiptJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->crj_jevnum = '';
    }

    public function render()
    {
        return view('livewire.cash-receipt-journal-trash');
    }
}
