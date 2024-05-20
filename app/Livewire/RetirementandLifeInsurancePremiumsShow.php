<?php

namespace App\Livewire;

use App\Exports\RetirementandLifeInsurancePremiumsExport;
use App\Imports\RetirementandLifeInsurancePremiumsImport;
use App\Models\RetirementandLifeInsurancePremiumsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RetirementandLifeInsurancePremiumsShow extends Component
{
    public function render()
    {
        return view('livewire.retirementand-life-insurance-premiums-show');
    }
}
