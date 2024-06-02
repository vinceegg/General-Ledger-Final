<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LedgerSheetModel;

class LedgerSheetTrash extends Component
{
    public $ls_vouchernum;
    public $deleteType;
    public $softDeletedData;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    public $file;
    public $ls_accountname;
    public $ledger_sheet;

    public function mount()
    {
        $this->softDeletedData = LedgerSheetModel::onlyTrashed()->get();
    }

    // Method to restore soft-deleted record
    public function restoreGeneralLedger($ls_vouchernum)
    {
        $general_ledger = LedgerSheetModel::onlyTrashed()->find($ls_vouchernum);
        if ($general_ledger) {
            $general_ledger->restore();
            session()->flash('message', 'Record restored successfully.');
            $this->softDeletedData = LedgerSheetModel::onlyTrashed()->get();
        }
    }

    public function deleteGeneralLedger(string $ls_vouchernum, $type = 'soft')
    {
        $this->ls_vouchernum = $ls_vouchernum;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyGeneralLedger()
    {
        $general_ledger = LedgerSheetModel::withTrashed()->find($this->ls_vouchernum);
        if ($this->deleteType == 'force') {
            $general_ledger->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $general_ledger->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('LedgerSheetArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->ls_vouchernum = '';
    }

    public function setAccountName($value)
    {
        $this->ls_accountname = $value;
    }

    public function fetchGeneralLedgerData()
    {
        // Check if ls_accountname is set
        if ($this->ls_accountname) {
            // Fetch general ledger data filtered by ls_accountname
            $this->softDeletedData = LedgerSheetModel::onlyTrashed()->where('ls_accountname', $this->ls_accountname)->get();
        } else {
            // If ls_accountname is not set, fetch all general ledger data
            $this->softDeletedData = LedgerSheetModel::onlyTrashed()->get();;
        }
    }

    public function render()
    {
        $this->fetchGeneralLedgerData();
        return view('livewire.ledger-sheet-trash');
    }
}
