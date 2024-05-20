<?php

namespace App\Livewire;

use App\Exports\AccountsPayableExport;
use App\Imports\AccountsPayableImport;
use App\Models\AccountsPayableModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class AccountsPayableShow extends Component
{
    public function render()
    {
        return view('livewire.accounts-payable-show');
    }
}
