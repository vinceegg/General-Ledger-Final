<?php

namespace App\Livewire;

use App\Exports\AffiliationFeesExport;
use App\Imports\AffiliationFeesImport;
use App\Models\AffiliationFeesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AffiliationFeesShow extends Component
{
    public function render()
    {
        return view('livewire.affiliation-fees-show');
    }
}
