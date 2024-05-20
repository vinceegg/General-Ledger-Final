<?php

namespace App\Livewire;

use App\Exports\OtherMaintenanceandOperatingExpensesExport;
use App\Imports\OtherMaintenanceandOperatingExpensesImport;
use App\Models\OtherMaintenanceandOperatingExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherMaintenanceandOperatingExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.other-maintenanceand-operating-expenses-show');
    }
}
