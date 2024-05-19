<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationMedicalEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationMedicalEquipmentArchived');
    }
}
