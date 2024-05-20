<?php

namespace App\Livewire;

use App\Exports\RentIncomeExport;
use App\Imports\RentIncomeImport;
use App\Models\RentIncomeModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RentIncomeShow extends Component
{
    public function render()
    {
        return view('livewire.rent-income-show');
    }
}
