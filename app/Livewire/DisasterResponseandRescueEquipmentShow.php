<?php

namespace App\Livewire;

use App\Exports\DisasterResponseandRescueEquipmentExport;
use App\Imports\DisasterResponseandRescueEquipmentImport;
use App\Models\DisasterResponseandRescueEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DisasterResponseandRescueEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.disaster-responseand-rescue-equipment-show');
    }
}
