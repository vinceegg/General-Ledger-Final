<?php

namespace App\Livewire;

use App\Exports\MembershipDuesandContributiontoOrgExport;
use App\Imports\MembershipDuesandContributiontoOrgImport;
use App\Models\MembershipDuesandContributiontoOrgModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class MembershipDuesandContributiontoOrgShow extends Component
{
    public function render()
    {
        return view('livewire.membership-duesand-contributionto-org-show');
    }
}
