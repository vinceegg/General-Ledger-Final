<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepreciationMachineryandEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DepreciationMachineryandEquipmentArchive');
    }
}
