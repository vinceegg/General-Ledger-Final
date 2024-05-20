<?php

namespace App\Livewire;

use App\Exports\TelephoneExpensesExport;
use App\Imports\TelephoneExpensesImport;
use App\Models\TelephoneExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TelephoneExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.telephone-expenses-show');
    }
}
