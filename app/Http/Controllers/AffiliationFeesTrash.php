<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliationFeesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AffiliationFeesArchive');
    }
}
