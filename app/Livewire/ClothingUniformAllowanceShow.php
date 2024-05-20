<?php

namespace App\Livewire;

use App\Exports\ClothingUniformAllowanceExport;
use App\Imports\ClothingUniformAllowanceImport;
use App\Models\ClothingUniformAllowanceModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class ClothingUniformAllowanceShow extends Component
{
    public function render()
    {
        return view('livewire.clothing-uniform-allowance-show');
    }
}
