<?php

namespace App\Livewire;

use App\Exports\TransportationAllowanceExport;
use App\Imports\TransportationAllowanceImport;
use App\Models\TransportationAllowanceModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TransportationAllowanceShow extends Component
{
    public function render()
    {
        return view('livewire.transportation-allowance-show');
    }
}
