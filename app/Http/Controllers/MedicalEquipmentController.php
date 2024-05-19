<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalEquipmentController extends Controller
{
    public function index()
    {
        return view('accountcode.MedicalEquipment');
    }
}
