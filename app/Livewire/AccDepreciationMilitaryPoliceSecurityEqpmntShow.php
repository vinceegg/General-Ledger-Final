<?php

namespace App\Livewire;

use App\Exports\AccDepreciationMilitaryPoliceSecurityEqpmntExport;
use App\Imports\AccDepreciationMilitaryPoliceSecurityEqpmntImport;
use App\Models\AccDepreciationMilitaryPoliceSecurityEqpmntModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccDepreciationMilitaryPoliceSecurityEqpmntShow extends Component
{
    public function render()
    {
        return view('livewire.acc-depreciation-military-police-security-eqpmnt-show');
    }
}
