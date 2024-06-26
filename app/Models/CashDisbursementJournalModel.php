<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\CDJ_SundryModel;

class CashDisbursementJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'cash_disbursement_journal';

    protected $primaryKey = 'cashdisbursementjournal_no'; // Specify the new primary key

    public $incrementing = true; // Since the primary key is not auto-incrementing

    protected $keyType = 'int'; 

    protected $fillable = [
        'cdj_jevnum',
        'cdj_entrynum_date',
        'cdj_referencenum',
        'cdj_bur', 
        'cdj_accountable_officer',
        'cdj_credit_accountcode',
        'cdj_amount',
        'cdj_account1',
        'cdj_account2',
    ];

    //@korinlv: added  this
    public function cdj_sundry_data()
    {
        return $this->hasMany(CDJ_SundryModel::class, 'cashdisbursementjournal_no');
    }

    protected static $logAttributes = ['*'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(self::$logAttributes);
    }

    public function getDescriptionForEvent(string $eventName): string
    {

        $tableName = "Cash Disbursement Journal";
        
        return "{$tableName}";
        
    }

    protected function getCauser()
    {
        return User::find($this->employee_id);
    }

}