<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MilitaryPoliceSecurityEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MilitaryPoliceSecurityEquipmentArchive');
    }
}
