<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairsandMaintBuildingOtherStructuresTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RepairsandMaintBuildingOtherStructuresArchive');
    }
}
