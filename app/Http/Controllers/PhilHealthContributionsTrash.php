<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhilHealthContributionsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PhilHealthContributionsArchived');
    }
}
