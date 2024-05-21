<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CKDJ_SundryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ckdj_sundry_data';

    protected $fillable = [
        'check_disbursement_journal_id',
        'ckdj_accountcode',
        'ckdj_debit',
        'ckdj_credit',
    ];

    public function checkDisbursementJournal()
    {
        return $this->belongsTo(CheckDisbursementJournalModel::class, 'check_disbursement_journal_id');
    }
}
