<?php

namespace App\Livewire;

use App\Exports\PostageandCourierServicesExport;
use App\Imports\PostageandCourierServicesImport;
use App\Models\PostageandCourierServicesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class PostageandCourierServicesShow extends Component
{
    public function render()
    {
        return view('livewire.postageand-courier-services-show');
    }
}
