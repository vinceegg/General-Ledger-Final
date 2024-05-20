<?php

namespace App\Livewire;

use App\Exports\GuarantySecurityDepositsPayableExport;
use App\Imports\GuarantySecurityDepositsPayableImport;
use App\Models\GuarantySecurityDepositsPayableModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class GuarantySecurityDepositsPayableShow extends Component
{
    public function render()
    {
        return view('livewire.guaranty-security-deposits-payable-show');
    }
}
