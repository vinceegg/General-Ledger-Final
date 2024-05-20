<?php

namespace App\Livewire;

use App\Exports\MedicalEquipmentExport;
use App\Imports\MedicalEquipmentImport;
use App\Models\MedicalEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MedicalEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.medical-equipment-show');
    }
}
