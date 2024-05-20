<?php

namespace App\Livewire;

use App\Exports\InterestIncomeExport;
use App\Imports\InterestIncomeImport;
use App\Models\InterestIncomeModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class InterestIncomeShow extends Component
{
    public function render()
    {
        return view('livewire.interest-income-show');
    }
}
