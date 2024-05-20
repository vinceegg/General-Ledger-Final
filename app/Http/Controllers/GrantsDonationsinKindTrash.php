<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrantsDonationsinKindTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.GrantsDonationsinKindArchive');
    }
}

