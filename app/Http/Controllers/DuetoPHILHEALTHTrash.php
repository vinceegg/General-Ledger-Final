<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuetoPHILHEALTHTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DuetoPHILHEALTHArchived');
    }
}
