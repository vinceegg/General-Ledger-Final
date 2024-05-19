<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairsandMaintTransportationEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RepairsandMaintTransportationEquipmentArchived');
    }
}
