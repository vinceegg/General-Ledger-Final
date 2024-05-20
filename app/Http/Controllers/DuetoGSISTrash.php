<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuetoGSISTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DuetoGSISArchive');
    }
}
