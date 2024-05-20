<?php

namespace App\Livewire;

use App\Exports\MilitaryPoliceSecurityEquipmentExport;
use App\Imports\MilitaryPoliceSecurityEquipmentImport;
use App\Models\MilitaryPoliceSecurityEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MilitaryPoliceSecurityEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.military-police-security-equipment-show');
    }
}
