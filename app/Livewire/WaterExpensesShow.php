<?php

namespace App\Livewire;

use App\Exports\WaterExpensesExport;
use App\Imports\WaterExpensesImport;
use App\Models\WaterExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class WaterExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.water-expenses-show');
    }
}
