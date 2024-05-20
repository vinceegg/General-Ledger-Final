<?php

namespace App\Livewire;

use App\Exports\RepresentationAllowanceExport;
use App\Imports\RepresentationAllowanceImport;
use App\Models\RepresentationAllowanceModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class RepresentationAllowanceShow extends Component
{
    public function render()
    {
        return view('livewire.representation-allowance-show');
    }
}
