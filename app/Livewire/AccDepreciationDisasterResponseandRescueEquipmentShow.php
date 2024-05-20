<?php

namespace App\Livewire;

use App\Exports\AccDepreciationDisasterResponseandRescueEquipmentExport;
use App\Imports\AccDepreciationDisasterResponseandRescueEquipmentImport;
use App\Models\AccDepreciationDisasterResponseandRescueEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccDepreciationDisasterResponseandRescueEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.acc-depreciation-disaster-responseand-rescue-equipment-show');
    }
}
