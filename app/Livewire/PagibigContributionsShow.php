<?php

namespace App\Livewire;

use App\Exports\PagibigContributionsExport;
use App\Imports\PagibigContributionsImport;
use App\Models\PagibigContributionsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PagibigContributionsShow extends Component
{
    public function render()
    {
        return view('livewire.pagibig-contributions-show');
    }
}
