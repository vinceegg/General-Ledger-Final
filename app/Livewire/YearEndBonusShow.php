<?php

namespace App\Livewire;

use App\Exports\YearEndBonusExport;
use App\Imports\YearEndBonusImport;
use App\Models\YearEndBonusModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class YearEndBonusShow extends Component
{
    public function render()
    {
        return view('livewire.year-end-bonus-show');
    }
}
