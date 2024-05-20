<?php

namespace App\Livewire;

use App\Exports\LongetivityPayExport;
use App\Imports\LongetivityPayImport;
use App\Models\LongetivityPayModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class LongetivityPayShow extends Component
{
    public function render()
    {
        return view('livewire.longetivity-pay-show');
    }
}
