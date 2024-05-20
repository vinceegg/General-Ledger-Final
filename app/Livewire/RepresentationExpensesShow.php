<?php

namespace App\Livewire;

use App\Exports\RepresentationExpensesExport;
use App\Imports\RepresentationExpensesImport;
use App\Models\RepresentationExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RepresentationExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.representation-expenses-show');
    }
}
