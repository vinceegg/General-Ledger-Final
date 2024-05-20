<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationICTEquipmentExport;
use App\Imports\AccumulatedDepreciationICTEquipmentImport;
use App\Models\AccumulatedDepreciationICTEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
class AccumulatedDepreciationICTEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-i-c-t-equipment');
    }
}
