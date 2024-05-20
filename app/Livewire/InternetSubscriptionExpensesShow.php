<?php

namespace App\Livewire;

use App\Exports\InternetSubscriptionExpensesExport;
use App\Imports\InternetSubscriptionExpensesImport;
use App\Models\InternetSubscriptionExpensesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class InternetSubscriptionExpensesShow extends Component
{
    public function render()
    {
        return view('livewire.internet-subscription-expenses-show');
    }
}
