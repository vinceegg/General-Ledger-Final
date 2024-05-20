<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoandCommunicationTechnologyEquipmentTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.InfoandCommunicationTechnologyEquipmentArchive');
    }
}