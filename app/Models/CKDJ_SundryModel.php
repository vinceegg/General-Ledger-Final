<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CheckDisbursementJournalModel;

class CKDJ_SundryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ckdj_sundry_data';

    protected $primaryKey = 'ckdj_id'; 

    public $incrementing = true; 

    protected $keyType = 'int';

    protected $fillable = [
        'ckdj_accountcode',
        'ckdj_debit',
        'ckdj_credit',
    ];

    public function checkDisbursementJournal()
    {
        return $this->belongsTo(CheckDisbursementJournalModel::class, 'checkdisbursementjournal_no');
    }
}
