<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\CKDJ_SundryModel;

class CheckDisbursementJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'check_disbursement_journal';

    
    protected $primaryKey = 'checkdisbursementjournal_no'; 

    public $incrementing = true; 

    protected $keyType = 'int'; 

    protected $fillable = [
        'ckdj_checknum',
        'ckdj_jevnum',
        'ckdj_entrynum_date',
        'ckdj_payee',
        'ckdj_bur',
        'ckdj_cib_lcca',
        'ckdj_account1',
        'ckdj_account2',
        'ckdj_account3',
        'ckdj_salary_wages',
        'ckdj_honoraria',
    ];

    //@korinlv: added this function
    public function ckdj_sundry_data()
    {
        return $this->hasMany(CKDJ_SundryModel::class, 'checkdisbursementjournal_no');
    }

    protected static $logAttributes = ['*'];
        
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(self::$logAttributes);
    }

    public function getDescriptionForEvent(string $eventName): string
    {

        $tableName = "Check Disbursement Journal";
        
        return "{$tableName}";
    }

    protected function getCauser()
    {
        return User::find($this->employee_id);
    }
}