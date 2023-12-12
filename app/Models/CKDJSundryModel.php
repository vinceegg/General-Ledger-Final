<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CKDJSundryModel extends Model
{
    use HasFactory;

    protected $table = "ckdj_sundry";

    protected $fillable = [
        'ckdj_sundry_account_code',
        'ckdj_sundry_debit',
        'ckdj_sundry_credit',
    ];

    
    


}