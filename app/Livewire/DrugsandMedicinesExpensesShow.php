<?php

namespace App\Livewire;

use App\Exports\DrugsandMedicinesExpensesExport;
use App\Imports\DrugsandMedicinesExpensesImport;
use App\Models\DrugsandMedicinesExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DrugsandMedicinesExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.drugsand-medicines-expenses-show');
    }
}
