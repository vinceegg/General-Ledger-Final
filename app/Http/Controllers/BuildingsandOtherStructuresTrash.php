<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildingsandOtherStructuresTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.BuildingsandOtherStructuresArchived');
    }
}
