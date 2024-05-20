<?php

namespace App\Livewire;

use App\Exports\AccumulatedDepreciationFurnitureandFixturesExport;
use App\Imports\AccumulatedDepreciationFurnitureandFixturesImport;
use App\Models\AccumulatedDepreciationFurnitureandFixturesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccumulatedDepreciationFurnitureandFixturesShow extends Component
{
    public function render()
    {
        return view('livewire.accumulated-depreciation-furnitureand-fixtures-show');
    }
}
