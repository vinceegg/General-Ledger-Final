<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnicalandScientificEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.TechnicalandScientificEquipmentArchived');
    }
}
