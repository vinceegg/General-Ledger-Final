<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationMedicalEquipmentExport;
use App\Imports\AccumulatedDepreciationMedicalEquipmentImport;
use App\Models\AccumulatedDepreciationMedicalEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccumulatedDepreciationMedicalEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-medical-equipment-show');
    }
}
