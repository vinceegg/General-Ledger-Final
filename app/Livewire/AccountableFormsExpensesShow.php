<?php

namespace App\Livewire;

use App\Exports\AccountableFormsExpensesExport;
use App\Imports\AccountableFormsExpensesImport;
use App\Models\AccountableFormsExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccountableFormsExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.accountable-forms-expenses-show');
    }
}
