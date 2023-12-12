<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SearchModel extends Model
{
    use HasFactory;


    public static function getAllData()
    {

        $ckdj_data = DB::table('check_disbursement_journal')->get();
        $crj_data = DB::table('cash_receipt_journal')->get();
        $cdj_data = DB::table('cash_disbursement_journal')->get();
        $gj_data = DB::table('general_journal')->get();
        $gl_data = DB::table('general_ledger')->get();


        // Combine or process the data as needed
        $allData = [

            //format - tablename => $variable
            'check_disbursement_journal' => $ckdj_data,
            'cash_receipt_journal' => $crj_data,
            'cash_disbursement_journal' => $cdj_data,
            'general_journal' => $gj_data,
            'general_ledger' => $gl_data

        ];

        return $allData;
    }
}