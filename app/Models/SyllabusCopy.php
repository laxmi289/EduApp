<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyllabusCopy extends Model
{
    protected $table = 'syllabus_copy';
    protected $fillable = ['user_id','dept_id','sem','scheme','academic_year','file_path','approval'];
}
