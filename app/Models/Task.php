<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SOftDeletes;

class Task extends Model
{
    use SOftDeletes;

    protected $fillable = ['title', 'description', 'status', 'due_date'];
}
