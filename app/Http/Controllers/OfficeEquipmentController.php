<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeEquipmentController extends Controller
{
    public function index()
    {
        return view('accountcode.OfficeEquipment');
    }
}
