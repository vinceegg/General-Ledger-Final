<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CDJSundryModel extends Model
{
    use HasFactory;
    
    protected $table = 'cdj_sundry';

    protected $fillable = [
        'cdj_sundry_account_code',
        'cdj_sundry_pr',
        'cdj_sundry_debit',
        'cdj_sundry_credit'
    ];
}