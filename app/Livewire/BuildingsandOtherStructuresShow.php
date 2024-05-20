<?php

namespace App\Livewire;

use App\Exports\BuildingsandOtherStructuresExport;
use App\Imports\BuildingsandOtherStructuresImport;
use App\Models\BuildingsandOtherStructuresModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class BuildingsandOtherStructuresShow extends Component
{
    public function render()
    {
        return view('livewire.buildingsand-other-structures-show');
    }
}
