<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MedicalEquipmentArchived');
    }
}