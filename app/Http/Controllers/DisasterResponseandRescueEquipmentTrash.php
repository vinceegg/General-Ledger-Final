<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisasterResponseandRescueEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DisasterResponseandRescueEquipmentArchived');
    }
}
