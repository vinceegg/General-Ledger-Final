<?php

namespace App\Livewire;

use App\Exports\SalariesandWagesCasualContractualExport;
use App\Imports\SalariesandWagesCasualContractualImport;
use App\Models\SalariesandWagesCasualContractualModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SalariesandWagesCasualContractualShow extends Component
{
    public function render()
    {
        return view('livewire.salariesand-wages-casual-contractual-show');
    }
}
