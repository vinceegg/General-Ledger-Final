<?php

namespace App\Livewire;

use App\Exports\SubscriptionExpensesExport;
use App\Imports\SubscriptionExpensesImport;
use App\Models\SubscriptionExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class SubscriptionExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.subscription-expenses-show');
    }
}
