<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FurnitureandFixturesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.FurnitureandFixturesArchive');
    }
}
