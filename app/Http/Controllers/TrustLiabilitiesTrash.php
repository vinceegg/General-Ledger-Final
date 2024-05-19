<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrustLiabilitiesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TrustLiabilitiesArchived');
    }
}
