<?php

namespace App\Livewire;

use App\Exports\TravelingExpensesLocalExport;
use App\Imports\TravelingExpensesLocalImport;
use App\Models\TravelingExpensesLocalModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TravelingExpensesLocalShow extends Component
{
    public function render()
    {
        return view('livewire.traveling-expenses-local-show');
    }
}
