<?php

namespace App\Livewire;

use App\Exports\InterestsReceivableExport;
use App\Imports\InterestsReceivableImport;
use App\Models\InterestsReceivableModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class InterestsReceivableShow extends Component
{
    public function render()
    {
        return view('livewire.interests-receivable-show');
    }
}
