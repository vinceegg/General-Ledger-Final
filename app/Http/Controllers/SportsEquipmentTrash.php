<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SportsEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.SportsEquipmentArchived');
    }
}
