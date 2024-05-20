<?php

namespace App\Livewire;

use App\Exports\GovernmentEquityExport;
use App\Imports\GovernmentEquityImport;
use App\Models\GovernmentEquityModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class GovernmentEquityShow extends Component
{
    public function render()
    {
        return view('livewire.government-equity-show');
    }
}
