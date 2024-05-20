<?php

namespace App\Livewire;

use App\Exports\FidelityBondPremiumsExport;
use App\Imports\FidelityBondPremiumsImport;
use App\Models\FidelityBondPremiumsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class FidelityBondPremiumsShow extends Component
{
    public function render()
    {
        return view('livewire.fidelity-bond-premiums-show');
    }
}
