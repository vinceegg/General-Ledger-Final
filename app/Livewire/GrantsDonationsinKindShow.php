<?php

namespace App\Livewire;

use App\Exports\GrantsDonationsinKindExport;
use App\Imports\GrantsDonationsinKindImport;
use App\Models\GrantsDonationsinKindModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class GrantsDonationsinKindShow extends Component
{
    public function render()
    {
        return view('livewire.grants-donationsin-kind-show');
    }
}
