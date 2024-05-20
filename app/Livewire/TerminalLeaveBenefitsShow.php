<?php

namespace App\Livewire;

use App\Exports\TerminalLeaveBenefitsExport;
use App\Imports\TerminalLeaveBenefitsImport;
use App\Models\TerminalLeaveBenefitsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TerminalLeaveBenefitsShow extends Component
{
    public function render()
    {
        return view('livewire.terminal-leave-benefits-show');
    }
}
