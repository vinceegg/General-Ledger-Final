<?php

namespace App\Livewire;

use App\Exports\FuelOilandLubricantsExpensesExport;
use App\Imports\FuelOilandLubricantsExpensesImport;
use App\Models\FuelOilandLubricantsExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class FuelOilandLubricantsExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.fuel-oiland-lubricants-expenses-show');
    }
}
