<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DepreciationTransportationEquipmentModel;

class DepreciationTransportationEquipmentTrash extends Component
{
    public $general_ledger_id;
    public $deleteType;
    public $softDeletedData;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    public $file;

    public function mount()
    {
        $this->softDeletedData = DepreciationTransportationEquipmentModel::onlyTrashed()->get();
    }

    // Method to restore soft-deleted record
    public function restoreGeneralLedger($id)
    {
        $general_ledger = DepreciationTransportationEquipmentModel::onlyTrashed()->find($id);
        if ($general_ledger) {
            $general_ledger->restore();
            session()->flash('message', 'Record restored successfully.');
            $this->softDeletedData = DepreciationTransportationEquipmentModel::onlyTrashed()->get();
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
        $general_ledger = DepreciationTransportationEquipmentModel::withTrashed()->find($this->general_ledger_id);
        if ($this->deleteType == 'force') {
            $general_ledger->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $general_ledger->delete();
            session()->flash('message', 'Archived Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
        return redirect()->route('DepreciationTransportationEquipmentArchived')->with('message', 'Deleted Successfully');
    }

    public function resetInput()
    {
        $this->general_ledger_id = '';
    }

    public function render()
    {
        return view('livewire.fines-and-penalties-service-income-trash', [
            'softDeletedData' => $this->softDeletedData
        ]);
    }
}
