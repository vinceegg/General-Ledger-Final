<?php

namespace App\Livewire;

use App\Exports\OtherProfessionalServicesExport;
use App\Imports\OtherProfessionalServicesImport;
use App\Models\OtherProfessionalServicesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherProfessionalServicesShow extends Component
{
    public function render()
    {
        return view('livewire.other-professional-services-show');
    }
}
