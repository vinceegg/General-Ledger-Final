<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ledgerSheetTotalDebitCreditModel extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'ledgersheet_total_debit_credit';
    protected $primaryKey = 'ls_total_id';
    public $incrementing = false;

    protected $fillable = [
        'ls_accountname',
        'ls_summary_type',
        'ls_summary_month',
        'ls_summary_year',
        'ls_total_credit',
        'ls_total_debit',
    ];
}
