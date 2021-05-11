<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assigned_Subjects extends Model
{
    protected $table = 'assigned_subjects';
    protected $fillable = ['faculty_id','sub_code'];
}
