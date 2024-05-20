<?php

namespace App\Livewire;

use App\Exports\FinesandPenaltiesServiceIncomeExport;
use App\Imports\FinesandPenaltiesServiceIncomeImport;
use App\Models\FinesandPenaltiesServiceIncomeModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class FinesandPenaltiesServiceIncomeShow extends Component
{
    public function render()
    {
        return view('livewire.finesand-penalties-service-income-show');
    }
}
