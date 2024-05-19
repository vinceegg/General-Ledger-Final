<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationOfficeEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationOfficeEquipmentArchived');
    }
}
