<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalariesandWagesCasualContractualTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.SalariesandWagesCasualContractualArchived');
    }
}
