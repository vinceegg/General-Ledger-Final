<?php

namespace App\Livewire;

use App\Exports\PersonnelEconomicReliefAllowanceExport;
use App\Imports\PersonnelEconomicReliefAllowanceImport;
use App\Models\PersonnelEconomicReliefAllowanceModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PersonnelEconomicReliefAllowanceShow extends Component
{
    public function render()
    {
        return view('livewire.personnel-economic-relief-allowance-show');
    }
}
