<?php

namespace App\Livewire;

use App\Exports\AccDepreciationOtherMachineryEquipmentExport;
use App\Imports\AccDepreciationOtherMachineryEquipmentImport;
use App\Models\AccDepreciationOtherMachineryEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccDepreciationOtherMachineryEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.acc-depreciation-other-machinery-equipment-show');
    }
}
