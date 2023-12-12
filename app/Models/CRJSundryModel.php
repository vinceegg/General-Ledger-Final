<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRJSundryModel extends Model
{
    use HasFactory;

    protected $table = "crj_sundry";

    protected $fillable = [
        'crj_sundry_account_code',
        'crj_sundry_debit',
        'crj_sundry_credit',
    ];

}