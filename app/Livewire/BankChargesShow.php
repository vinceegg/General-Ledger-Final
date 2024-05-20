<?php

namespace App\Livewire;

use App\Exports\BankChargesExport;
use App\Imports\BankChargesImport;
use App\Models\BankChargesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class BankChargesShow extends Component
{
    public function render()
    {
        return view('livewire.bank-charges-show');
    }
}
