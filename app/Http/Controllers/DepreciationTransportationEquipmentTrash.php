<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepreciationTransportationEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DepreciationTransportationEquipmentArchive');
    }
}
