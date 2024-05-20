<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccumulatedDepreciationMotorVehiclesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.AccumulatedDepreciationMotorVehiclesArchive');
    }
}
