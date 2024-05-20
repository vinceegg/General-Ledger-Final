<?php

namespace App\Livewire;

use App\Exports\MiscellaneousIncomeExport;
use App\Imports\MiscellaneousIncomeImport;
use App\Models\MiscellaneousIncomeModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MiscellaneousIncomeShow extends Component
{
    public function render()
    {
        return view('livewire.miscellaneous-income-show');
    }
}
