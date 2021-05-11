<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IaTimeTable extends Model
{
    protected $table = 'ia_timetable';
    protected $fillable = ['user_id','dept_id','sem','scheme','academic_year','file_path','approval'];
}
