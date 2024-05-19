<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairsandMaintMachineryandEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.RepairsandMaintMachineryandEquipmentArchived');
    }
}
