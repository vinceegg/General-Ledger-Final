<?php

namespace App\Livewire;

use App\Exports\MotorVehiclesExport;
use App\Imports\MotorVehiclesImport;
use App\Models\MotorVehiclesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MotorVehiclesShow extends Component
{
    public function render()
    {
        return view('livewire.motor-vehicles-show');
    }
}
