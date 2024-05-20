<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherProfessionalServicesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherProfessionalServicesArchive');
    }
}
