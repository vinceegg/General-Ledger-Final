<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationSportsEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationSportsEquipmentArchived');
    }
}

