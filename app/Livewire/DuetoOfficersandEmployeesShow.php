<?php

namespace App\Livewire;

use App\Exports\DuetoOfficersandEmployeesExport;
use App\Imports\DuetoOfficersandEmployeesImport;
use App\Models\DuetoOfficersandEmployeesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DuetoOfficersandEmployeesShow extends Component
{
    public function render()
    {
        return view('livewire.dueto-officersand-employees-show');
    }
}
