<?php

namespace App\Livewire;

use App\Exports\SchoolFeesExport;
use App\Imports\SchoolFeesImport;
use App\Models\SchoolFeesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SchoolFeesShow extends Component
{
    public function render()
    {
        return view('livewire.school-fees-show');
    }
}
