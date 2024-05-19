<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HonorariaTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.HonorariaArchived');
    }
}

