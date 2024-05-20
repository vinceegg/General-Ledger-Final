<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherMachineryEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherMachineryEquipmentArchive');
    }
}
