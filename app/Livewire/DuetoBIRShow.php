<?php

namespace App\Livewire;

use App\Exports\DuetoBIRExport;
use App\Imports\DuetoBIRImport;
use App\Models\DuetoBIRModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DuetoBIRShow extends Component
{
    public function render()
    {
        return view('livewire.dueto-b-i-r-show');
    }
}
