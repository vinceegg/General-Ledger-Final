<?php

namespace App\Livewire;

use App\Exports\DepreciationBuildingandStructuresExport;
use App\Imports\DepreciationBuildingandStructuresImport;
use App\Models\DepreciationBuildingandStructuresModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DepreciationBuildingandStructuresShow extends Component
{
    public function render()
    {
        return view('livewire.depreciation-buildingand-structures-show');
    }
}
