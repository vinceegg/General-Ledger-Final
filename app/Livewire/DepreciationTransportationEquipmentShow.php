<?php

namespace App\Livewire;

use App\Exports\DepreciationTransportationEquipmentExport;
use App\Imports\DepreciationTransportationEquipmentImport;
use App\Models\DepreciationTransportationEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DepreciationTransportationEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.depreciation-transportation-equipment-show');
    }
}
