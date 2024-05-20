<?php

namespace App\Livewire;

use App\Exports\OtherDeferredCreditsExport;
use App\Imports\OtherDeferredCreditsImport;
use App\Models\OtherDeferredCreditsModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class OtherDeferredCreditsShow extends Component
{
    public function render()
    {
        return view('livewire.other-deferred-credits-show');
    }
}
