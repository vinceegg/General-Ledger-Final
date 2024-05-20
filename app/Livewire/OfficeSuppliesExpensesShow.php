<?php

namespace App\Livewire;

use App\Exports\OfficeSuppliesExpensesExport;
use App\Imports\OfficeSuppliesExpensesImport;
use App\Models\OfficeSuppliesExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OfficeSuppliesExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.office-supplies-expenses-show');
    }
}
