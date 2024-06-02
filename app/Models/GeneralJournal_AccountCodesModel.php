<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralJournal_AccountCodesModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gj_accountcodes_data';
 
    protected $primaryKey = 'gj_id'; // Specify the new primary key

    public $incrementing = true; // Ensure the primary key is auto-incrementing

    protected $keyType = 'int';

    protected $fillable = [
        'gj_accountcode',
        'gj_debit',
        'gj_credit',
    ];

    public function generalJournal()
    {
        return $this->belongsTo(GeneralJournalModel::class, 'generaljournal_no');
    }

}