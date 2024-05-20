<?php

namespace App\Livewire;

use App\Exports\SportsEquipmentExport;
use App\Imports\SportsEquipmentImport;
use App\Models\SportsEquipmentModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SportsEquipmentShow extends Component
{
    public function render()
    {
        return view('livewire.sports-equipment-show');
    }
}
