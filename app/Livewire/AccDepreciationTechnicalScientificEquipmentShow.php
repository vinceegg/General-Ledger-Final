<?php

namespace App\Livewire;

use App\Exports\AccDepreciationTechnicalScientificEquipmentExport;
use App\Imports\AccDepreciationTechnicalScientificEquipmentImport;
use App\Models\AccDepreciationTechnicalScientificEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccDepreciationTechnicalScientificEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.acc-depreciation-technical-scientific-equipment');
    }
}
