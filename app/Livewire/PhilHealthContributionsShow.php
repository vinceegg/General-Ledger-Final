<?php

namespace App\Livewire;

use App\Exports\PhilHealthContributionsExport;
use App\Imports\PhilHealthContributionsImport;
use App\Models\PhilHealthContributionsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PhilHealthContributionsShow extends Component
{
    public function render()
    {
        return view('livewire.phil-health-contributions-show');
    }
}
