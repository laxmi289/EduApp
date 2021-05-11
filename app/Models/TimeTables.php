<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTables extends Model
{
    protected $table = 'time_table';
    protected $fillable = ['username','dept_id','sem','scheme','academic_year','file_path','approval'];
}
