<?php

namespace App\Livewire;

use App\Exports\OtherPersonnelBenefitsExport;
use App\Imports\OtherPersonnelBenefitsImport;
use App\Models\OtherPersonnelBenefitsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherPersonnelBenefitsShow extends Component
{
    public function render()
    {
        return view('livewire.other-personnel-benefits-show');
    }
}
