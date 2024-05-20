<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationICTEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationICTEquipmentArchive');
    }
}
