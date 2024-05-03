<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class CheckDisbursementJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'check_disbursement_journal';

    protected $fillable = [
        'ckdj_entrynum_date',
        'ckdj_checknum',
        'ckdj_payee',
        'ckdj_bur',
        'ckdj_cib_lcca',
        'ckdj_account1',
        'ckdj_account2',
        'ckdj_account3',
        'ckdj_salary_wages',
        'ckdj_honoraria',
        'ckdj_sundry_accountcode',
        'ckdj_debit',
        'ckdj_credit',

    ];

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