<?php

namespace App\Livewire;

use App\Exports\ElectricityExpensesExport;
use App\Imports\ElectricityExpensesImport;
use App\Models\ElectricityExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class ElectricityExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.electricity-expenses-show');
    }
}
