<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralJournalModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'general_journal';
 
    protected $fillable = [
        'entrynumber',
        'date',
        'jevnumber',
        'particulars',
        'accountcode',
        'debit',
        'credit',
        'Journalcol',
    ];
}