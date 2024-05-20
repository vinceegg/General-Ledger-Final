<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationOfficeEquipmentExport;
use App\Imports\AccumulatedDepreciationOfficeEquipmentImport;
use App\Models\AccumulatedDepreciationOfficeEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccumulatedDepreciationOfficeEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-office-equipment-show');
    }
}
