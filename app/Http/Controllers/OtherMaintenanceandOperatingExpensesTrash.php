<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherMaintenanceandOperatingExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.OtherMaintenanceandOperatingExpensesArchived');
    }
}