<?php

namespace App\Livewire;

use App\Exports\EmployeesCompensationInsurancePremiumsExport;
use App\Imports\EmployeesCompensationInsurancePremiumsImport;
use App\Models\EmployeesCompensationInsurancePremiumsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class EmployeesCompensationInsurancePremiumsShow extends Component
{
    public function render()
    {
        return view('livewire.employees-compensation-insurance-premiums-show');
    }
}
