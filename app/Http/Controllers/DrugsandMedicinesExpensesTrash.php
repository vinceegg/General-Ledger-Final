<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugsandMedicinesExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.DrugsandMedicinesExpensesArchived');
    }
}
