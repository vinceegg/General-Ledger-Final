<?php

namespace App\Livewire;

use App\Exports\InfoandCommunicationTechnologyEquipmentExport;
use App\Imports\InfoandCommunicationTechnologyEquipmentImport;
use App\Models\InfoandCommunicationTechnologyEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class InfoandCommunicationTechnologyEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.infoand-communication-technology-equipment-show');
    }
}
