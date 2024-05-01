<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CashLocalTreasuryModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use LogsActivity;

    protected $table = 'cash_local_treasury';

    protected $fillable = [
        
        'gl_symbol',
        'gl_fundname',
        'gl_func_classification',
        'gl_project_title',
        'gl_date',
        'gl_vouchernum',
        'gl_particulars',
        'gl_balance_debit',
        'gl_debit',
        'gl_credit',
        'gl_credit_balance',

    ];

}
