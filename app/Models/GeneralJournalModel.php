<?php

namespace App\Models;

use App\Models\GeneralJournal_AccountCodesModel;  //@korinlv: added  this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class GeneralJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'general_journal';
 
    protected $fillable = [
        'gj_entrynum',
        'gj_entrynum_date',
        'gj_jevnum',
        'gj_particulars',
    ];

        //@korinlv: added  this
        public function gj_accountcodes_data()
        {
            return $this->hasMany(GeneralJournal_AccountCodesModel::class, 'general_journal_id');
        }
        
        protected static $logAttributes = ['*'];
    
        public function getActivitylogOptions(): LogOptions
        {
            return LogOptions::defaults()
                ->logOnly(self::$logAttributes);
        }

        public function getDescriptionForEvent(string $eventName): string
        {
            $tableName = "General Journal";
            
            return "{$tableName}";
        }

        protected function getCauser()
        {
            return User::find($this->employee_id);
        }

}