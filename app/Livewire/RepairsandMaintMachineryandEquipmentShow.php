<?php

namespace App\Livewire;

use App\Exports\RepairsandMaintMachineryandEquipmentExport;
use App\Imports\RepairsandMaintMachineryandEquipmentImport;
use App\Models\RepairsandMaintMachineryandEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RepairsandMaintMachineryandEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.repairsand-maint-machineryand-equipment-show');
    }
}
