<?php

namespace App\Livewire;

use App\Exports\TrainingExpensesExport;
use App\Imports\TrainingExpensesImport;
use App\Models\TrainingExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TrainingExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.training-expenses-show');
    }
}
