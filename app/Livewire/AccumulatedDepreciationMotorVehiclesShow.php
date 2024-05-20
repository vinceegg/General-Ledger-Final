<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationMotorVehiclesExport;
use App\Imports\AccumulatedDepreciationMotorVehiclesImport;
use App\Models\AccumulatedDepreciationMotorVehiclesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccumulatedDepreciationMotorVehiclesShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-motor-vehicles-show');
    }
}
