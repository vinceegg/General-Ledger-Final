<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class ledgerSheetModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'ledgersheet';
    protected $primaryKey = 'ls_vouchernum';
    public $incrementing = false;

    protected $fillable = [
        'ls_accountname',
        'ls_date',
        'ls_vouchernum',
        'ls_particulars',
        'ls_balance_debit',
        'ls_debit',
        'ls_credit',
        'ls_credit_balance',
    ];


        protected static $logAttributes = ['*'];
            
        public function getActivitylogOptions(): LogOptions
        {
            return LogOptions::defaults()
                ->logOnly(self::$logAttributes);
        }

        public function getDescriptionForEvent(string $eventName): string
        {

            $tableName = "Ledger Sheet";
            
            return "{$tableName}";
        }

        protected function getCauser()
        {
            return User::find($this->employee_id);
        }

}
