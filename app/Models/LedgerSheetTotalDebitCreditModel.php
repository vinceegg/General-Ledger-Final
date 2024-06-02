<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class LedgerSheetTotalDebitCreditModel extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'ledgersheet_total_debit_credit';
    protected $primaryKey = 'ls_totals_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }


    protected $fillable = [
        'ls_account_title_code',
        'ls_summary_type',
        'ls_summary_month',
        'ls_summary_year',
        'ls_total_credit',
        'ls_total_debit',
    ];
}
