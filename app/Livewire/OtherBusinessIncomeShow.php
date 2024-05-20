<?php

namespace App\Livewire;

use App\Exports\OtherBusinessIncomeExport;
use App\Imports\OtherBusinessIncomeImport;
use App\Models\OtherBusinessIncomeModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherBusinessIncomeShow extends Component
{
    public function render()
    {
        return view('livewire.other-business-income-show');
    }
}
