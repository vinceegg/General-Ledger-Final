<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClothingUniformAllowanceTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.ClothingUniformAllowanceArchived');
    }
}
