<?php

namespace App\Livewire;

use App\Exports\ExtraordinaryandMiscellaneousExpensesExport;
use App\Imports\ExtraordinaryandMiscellaneousExpensesImport;
use App\Models\ExtraordinaryandMiscellaneousExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class ExtraordinaryandMiscellaneousExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.extraordinaryand-miscellaneous-expenses-show');
    }
}
