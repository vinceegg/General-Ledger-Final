<?php

namespace App\Livewire;

use App\Exports\RentExpensesExport;
use App\Imports\RentExpensesImport;
use App\Models\RentExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RentExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.rent-expenses-show');
    }
}
