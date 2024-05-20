<?php

namespace App\Livewire;

use App\Exports\PriorPeriodAdjustmentExport;
use App\Imports\PriorPeriodAdjustmentImport;
use App\Models\PriorPeriodAdjustmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PriorPeriodAdjustmentShow extends Component
{
    public function render()
    {
        return view('livewire.prior-period-adjustment-show');
    }
}
