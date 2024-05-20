<?php

namespace App\Livewire;

use App\Exports\DuetoPAGIBIGExport;
use App\Imports\DuetoPAGIBIGImport;
use App\Models\DuetoPAGIBIGModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DuetoPAGIBIGShow extends Component
{
    public function render()
    {
        return view('livewire.dueto-p-a-g-i-b-i-g-show');
    }
}
