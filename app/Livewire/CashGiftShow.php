<?php

namespace App\Livewire;

use App\Exports\CashGiftExport;
use App\Imports\CashGiftImport;
use App\Models\CashGiftModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CashGiftShow extends Component
{
    public function render()
    {
        return view('livewire.cash-gift-show');
    }
}
