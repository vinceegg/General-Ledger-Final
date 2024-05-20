<?php

namespace App\Livewire;

use App\Exports\OvertimeandNightPayExport;
use App\Imports\OvertimeandNightPayImport;
use App\Models\OvertimeandNightPayModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OvertimeandNightPayShow extends Component
{
    public function render()
    {
        return view('livewire.overtimeand-night-pay-show');
    }
}
