<?php

namespace App\Livewire;

use App\Exports\MedicalDentalandLaboratorySuppliesExpensesExport;
use App\Imports\MedicalDentalandLaboratorySuppliesExpensesImport;
use App\Models\MedicalDentalandLaboratorySuppliesExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MedicalDentalandLaboratorySuppliesExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.medical-dentaland-laboratory-supplies-expenses-show');
    }
}
