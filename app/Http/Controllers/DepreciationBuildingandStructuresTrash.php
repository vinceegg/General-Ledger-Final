<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepreciationBuildingandStructuresTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DepreciationBuildingandStructuresArchive');
    }
}
