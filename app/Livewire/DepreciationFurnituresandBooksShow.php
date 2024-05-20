<?php

namespace App\Livewire;

use App\Exports\DepreciationFurnituresandBooksExport;
use App\Imports\DepreciationFurnituresandBooksImport;
use App\Models\DepreciationFurnituresandBooksModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class DepreciationFurnituresandBooksShow extends Component
{
    public function render()
    {
        return view('livewire.depreciation-furnituresand-books-show');
    }
}
