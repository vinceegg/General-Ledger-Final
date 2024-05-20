<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CRJ_SundryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'crj_sundry_data';

    protected $fillable = [
        'cash_receipt_journal_id',
        'crj_accountcode',
        'crj_debit',
        'crj_credit',
    ];

    public function cashReceiptJournal()
    {
        return $this->belongsTo(CashReceiptJournalModel::class, 'cash_receipt_journal_id');
    }    
}
