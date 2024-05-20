<?php

namespace App\Livewire;

use App\Exports\SubsidyfromLGUsExport;
use App\Imports\SubsidyfromLGUsImport;
use App\Models\SubsidyfromLGUsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SubsidyfromLGUsShow extends Component
{
    public function render()
    {
        return view('livewire.subsidyfrom-l-g-us-show');
    }
}
