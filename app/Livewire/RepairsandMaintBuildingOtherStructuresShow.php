<?php

namespace App\Livewire;

use App\Exports\RepairsandMaintBuildingOtherStructuresExport;
use App\Imports\RepairsandMaintBuildingOtherStructuresImport;
use App\Models\RepairsandMaintBuildingOtherStructuresModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RepairsandMaintBuildingOtherStructuresShow extends Component
{
    public function render()
    {
        return view('livewire.repairsand-maint-building-other-structures-show');
    }
}
