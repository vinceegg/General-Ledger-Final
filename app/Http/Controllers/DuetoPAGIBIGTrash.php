<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuetoPAGIBIGTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DuetoPAGIBIGArchived');
    }
}
