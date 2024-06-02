<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'todo_id'; // Specify the new primary key

    public $incrementing = true; // Ensure the primary key is auto-incrementing

    protected $keyType = 'int'; 
}
