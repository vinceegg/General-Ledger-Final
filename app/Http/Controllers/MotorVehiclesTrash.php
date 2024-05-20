<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotorVehiclesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.MotorVehiclesArchive');
    }
}
