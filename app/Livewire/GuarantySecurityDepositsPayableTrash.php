<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GuarantySecurityDepositsPayableModel;

class GuarantySecurityDepositsPayableTrash extends Component
{
    public $general_ledger_id;
    public $deleteType;
    public $softDeletedData;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    public $file;

    public function mount()
    {
        $this->softDeletedData = GuarantySecurityDepositsPayableModel::onlyTrashed()->get();
    }

    // Method to restore soft-deleted record
    public function restoreGeneralLedger($id)
    {
        $general_ledger = GuarantySecurityDepositsPayableModel::onlyTrashed()->find($id);
        if ($general_ledger) {
            $general_ledger->restore();
            session()->flash('message', 'Record restored successfully.');
            $this->softDeletedData = GuarantySecurityDepositsPayableModel::onlyTrashed()->get();
        }
    }

    public function deleteGeneralLedger(int $general_ledger_id, $type = 'soft')
    {
        $this->general_ledger_id = $general_ledger_id;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyGeneralLedger()
    {
        $general_ledger = GuarantySecurityDepositsPayableModel::withTrashed()->find($this->general_ledger_id);
        if ($this->deleteType == 'force') {
            $general_ledger->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $general_ledger->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('GuarantySecurityDepositsPayableArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->general_ledger_id = '';
    }

    public function render()
    {
        return view('livewire.guaranty-security-deposits-payable-trash', [
            'softDeletedData' => $this->softDeletedData
        ]);
    }
}