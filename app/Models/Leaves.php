<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    protected $fillable = ['username','name','department','from_date','to_date','leave_reason','leave_details','approved','responded'];
}
