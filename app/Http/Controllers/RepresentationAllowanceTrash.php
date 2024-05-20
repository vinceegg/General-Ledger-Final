<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentationAllowanceTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RepresentationAllowanceArchive');
    }
}

