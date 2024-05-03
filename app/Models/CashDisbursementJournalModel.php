<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;


class CashDisbursementJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    

    protected $table = 'cash_disbursement_journal';

    protected $fillable = [
            'cdj_entrynum_date',
            'cdj_referencenum',
            'cdj_accountable_officer',
            'cdj_jevnum',
            'cdj_accountcode',
            'cdj_amount',
            'cdj_account1',
            'cdj_account2',
            'cdj_sundry_accountcode',
            'cdj_pr',
            'cdj_debit',
            'cdj_credit',

        ];


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