<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccDepreciationTechnicalScientificEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccDepreciationTechnicalScientificEquipmentArchived');
    }
}
