<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\CRJ_SundryModel;

class CashReceiptJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    
    protected $table = 'cash_receipt_journal';

    protected $primaryKey = 'cashreceiptjournal_no';

    public $incrementing = true; 

    protected $keyType = 'int';

    protected $fillable = [
        'crj_entrynum_date',
        'crj_jevnum',
        'crj_payor',
        'crj_collection_debit',
        'crj_collection_credit',
        'crj_deposit_debit',
        'crj_deposit_credit',
    ];

    //@korinlv: added  this
    public function crj_sundry_data()
    {
        return $this->hasMany(CRJ_SundryModel::class, 'cashreceiptjournal_no');
    }

    protected static $logAttributes = ['*'];
            
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function getDescriptionForEvent(string $eventName): string
    {

        $tableName = "Cash Receipt Journal";
        
        return "{$tableName}";       
    }

    protected function getCauser()
    {
        return User::find($this->employee_id);
    }
}