<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class AccountableFormsExpensesModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'accountable_forms_expenses';

    protected $fillable = [
        'gl_date',
        'gl_vouchernum',
        'gl_particulars',
        'gl_balance_debit',
        'gl_debit',
        'gl_credit',
        'gl_credit_balance',
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
