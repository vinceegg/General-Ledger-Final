<?php

namespace App\Livewire;

use App\Exports\OtherSuppliesandMaterialsExpensesExport;
use App\Imports\OtherSuppliesandMaterialsExpensesImport;
use App\Models\OtherSuppliesandMaterialsExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherSuppliesandMaterialsExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.other-suppliesand-materials-expenses-show');
    }
}
