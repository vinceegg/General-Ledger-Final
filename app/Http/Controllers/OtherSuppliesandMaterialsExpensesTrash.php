<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherSuppliesandMaterialsExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherSuppliesandMaterialsExpensesArchived');
    }
}
