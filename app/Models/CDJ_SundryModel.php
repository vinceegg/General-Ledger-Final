<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CDJ_SundryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cdj_sundry_data';

    protected $fillable = [
        'cash_disbursement_journal_id',
        'cdj_pr',
        'cdj_sundry_accountcode',
        'cdj_debit',
        'cdj_credit',
    ];

    public function cashDisbursementJournal()
    {
        return $this->belongsTo(CashDisbursementJournalModel::class, 'cash_disbursement_journal_id');
    }
}
