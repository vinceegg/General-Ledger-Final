<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationSportsEquipmentExport;
use App\Imports\AccumulatedDepreciationSportsEquipmentImport;
use App\Models\AccumulatedDepreciationSportsEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccumulatedDepreciationSportsEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-sports-equipment-show');
    }
}
