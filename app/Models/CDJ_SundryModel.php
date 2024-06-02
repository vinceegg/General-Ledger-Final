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

    protected $primaryKey = 'cdj_id'; // Specify the new primary key

    public $incrementing = true; // Ensure the primary key is auto-incrementing

    protected $keyType = 'int'; 

    protected $fillable = [
        'cdj_pr',
        'cdj_sundry_accountcode',
        'cdj_debit',
        'cdj_credit',
    ];

    public function cashDisbursementJournal()
    {
        return $this->belongsTo(CashDisbursementJournalModel::class, 'cashdisbursementjournal_no');
    }
}