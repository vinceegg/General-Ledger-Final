<?php

namespace App\Livewire;

use App\Exports\FurnitureandFixturesExport;
use App\Imports\FurnitureandFixturesImport;
use App\Models\FurnitureandFixturesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class FurnitureandFixturesShow extends Component
{
    public function render()
    {
        return view('livewire.furnitureand-fixtures-show');
    }
}
