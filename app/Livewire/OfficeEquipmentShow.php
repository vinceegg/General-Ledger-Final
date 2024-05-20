<?php

namespace App\Livewire;

use App\Exports\OfficeEquipmentExport;
use App\Imports\OfficeEquipmentImport;
use App\Models\OfficeEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OfficeEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.office-equipment-show');
    }
}
