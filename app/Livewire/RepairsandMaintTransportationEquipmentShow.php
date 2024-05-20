<?php

namespace App\Livewire;

use App\Exports\RepairsandMaintTransportationEquipmentExport;
use App\Imports\RepairsandMaintTransportationEquipmentImport;
use App\Models\RepairsandMaintTransportationEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RepairsandMaintTransportationEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.repairsand-maint-transportation-equipment-show');
    }
}
