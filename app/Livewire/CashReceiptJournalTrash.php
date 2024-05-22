<?php

namespace App\Livewire;

use App\Models\CashReceiptJournalModel;
use Livewire\Component;
use App\Exports\CashReceiptJournalExport;
use App\Imports\CashReceiptJournalImport;
use App\Models\CRJ_SundryModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CashReceiptJournalTrash extends Component
{
    use WithFileUploads;

    public 
    $crj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $cash_receipt_journal_id;
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
    public function restoreCashReceiptJournal($id)
    {
        $cash_receipt_journal = CashReceiptJournalModel::onlyTrashed()->find($id);
        if ($cash_receipt_journal) {
            // Load trashed sundries
            $trashedSundries = $cash_receipt_journal->crj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $cash_receipt_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    public function deleteCashReceiptJournal(int $cash_receipt_journal_id, $type = 'soft')
    {
        $this->cash_receipt_journal_id = $cash_receipt_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCashReceiptJournal()
    {
        $cash_receipt_journal_id = CashReceiptJournalModel::withTrashed()->find($this->cash_receipt_journal_id);
        if ($this->deleteType == 'force') {
            $cash_receipt_journal_id->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $cash_receipt_journal_id->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('CashReceiptJournalArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this-> cash_receipt_journal_id = '';
    }
}
