<?php

namespace App\Livewire;

use App\Exports\TechnicalandScientificEquipmentExport;
use App\Imports\TechnicalandScientificEquipmentImport;
use App\Models\TechnicalandScientificEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TechnicalandScientificEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.technicaland-scientific-equipment-show');
    }
}
