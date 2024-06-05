<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CashReceiptJournalModel;

class CRJ_SundryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'crj_sundry_data';

    protected $primaryKey = 'crj_id'; // Specify the new primary key

    public $incrementing = true; // Ensure the primary key is auto-incrementing

    protected $keyType = 'int'; // Set the type of the primary key

    protected $fillable = [
        'crj_accountcode',
        'crj_debit',
        'crj_credit',
    ];

    public function cashReceiptJournal()
    {
        return $this->belongsTo(CashReceiptJournalModel::class, 'cashreceiptjournal_no');
    }
}
