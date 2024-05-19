<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotorVehiclesController extends Controller
{
    public function index()
    {
        return view('accountcode.MotorVehicles');
    }
}
