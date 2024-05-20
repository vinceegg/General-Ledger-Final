<?php

namespace App\Livewire;

use App\Exports\PrintingandPublicationExpensesExport;
use App\Imports\PrintingandPublicationExpensesImport;
use App\Models\PrintingandPublicationExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PrintingandPublicationExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.printingand-publication-expenses-show');
    }
}
