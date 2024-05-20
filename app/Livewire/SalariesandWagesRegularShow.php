<?php

namespace App\Livewire;

use App\Exports\SalariesandWagesRegularExport;
use App\Imports\SalariesandWagesRegularImport;
use App\Models\SalariesandWagesRegularModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SalariesandWagesRegularShow extends Component
{
    public function render()
    {
        return view('livewire.salariesand-wages-regular-show');
    }
}
