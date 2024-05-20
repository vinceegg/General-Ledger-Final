<?php

namespace App\Livewire;

use App\Exports\DuetoGSISExport;
use App\Imports\DuetoGSISImport;
use App\Models\DuetoGSISModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DuetoGSISShow extends Component
{
    public function render()
    {
        return view('livewire.dueto-g-s-i-s-show');
    }
}
