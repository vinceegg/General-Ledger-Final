<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherPersonnelBenefitsTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherPersonnelBenefitsArchived');
    }
}
