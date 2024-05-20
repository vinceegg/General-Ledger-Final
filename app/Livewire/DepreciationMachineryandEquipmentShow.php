<?php

namespace App\Livewire;

use App\Exports\DepreciationMachineryandEquipmentExport;
use App\Imports\DepreciationMachineryandEquipmentImport;
use App\Models\DepreciationMachineryandEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DepreciationMachineryandEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.depreciation-machineryand-equipment-show');
    }
}
