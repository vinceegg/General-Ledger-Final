<?php

namespace App\Livewire;

use App\Exports\DuetoPHILHEALTHExport;
use App\Imports\DuetoPHILHEALTHImport;
use App\Models\DuetoPHILHEALTHModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DuetoPHILHEALTHShow extends Component
{
    public function render()
    {
        return view('livewire.dueto-p-h-i-l-h-e-a-l-t-h-show');
    }
}
