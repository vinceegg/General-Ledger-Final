<?php

namespace App\Livewire;

use App\Exports\OtherPayablesExport;
use App\Imports\OtherPayablesImport;
use App\Models\OtherPayablesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherPayablesShow extends Component
{
    public function render()
    {
        return view('livewire.other-payables-show');
    }
}
