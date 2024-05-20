<?php

namespace App\Livewire;

use App\Exports\TrustLiabilitiesExport;
use App\Imports\TrustLiabilitiesImport;
use App\Models\TrustLiabilitiesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TrustLiabilitiesShow extends Component
{
    public function render()
    {
        return view('livewire.trust-liabilities-show');
    }
}
