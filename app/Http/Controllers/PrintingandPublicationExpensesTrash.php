<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintingandPublicationExpensesTrash extends Controller
{
    public function index()
    {
        return view('trashrecords.PrintingandPublicationExpensesArchive');
    }
}
