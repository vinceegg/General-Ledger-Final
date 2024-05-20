<?php

namespace App\Livewire;

use App\Exports\HazardPayExport;
use App\Imports\HazardPayImport;
use App\Models\HazardPayModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class HazardPayShow extends Component
{
    public function render()
    {
        return view('livewire.hazard-pay-show');
    }
}
