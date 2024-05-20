<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuetoOfficersandEmployeesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DuetoOfficersandEmployeesArchive');
    }
}
