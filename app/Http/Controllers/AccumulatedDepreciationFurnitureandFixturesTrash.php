<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationFurnitureandFixturesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationFurnitureandFixturesArchive');
    }
}
