<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubsidyfromLGUsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.SubsidyfromLGUsArchived');
    }
}
