<?php

namespace App\Livewire;

use App\Exports\InsuranceExpensesExport;
use App\Imports\InsuranceExpensesImport;
use App\Models\InsuranceExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class InsuranceExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.insurance-expenses-show');
    }
}
