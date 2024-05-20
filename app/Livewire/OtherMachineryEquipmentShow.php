<?php

namespace App\Livewire;

use App\Exports\OtherMachineryEquipmentExport;
use App\Imports\OtherMachineryEquipmentImport;
use App\Models\OtherMachineryEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherMachineryEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.other-machinery-equipment-show');
    }
}
