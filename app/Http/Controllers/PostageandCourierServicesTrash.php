<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostageandCourierServicesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PostageandCourierServicesArchived');
    }
}
