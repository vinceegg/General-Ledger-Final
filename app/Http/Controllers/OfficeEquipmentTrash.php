<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OfficeEquipmentArchive');
    }
}
