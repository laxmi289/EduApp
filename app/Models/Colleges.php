<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    protected $table = 'colleges';
    protected $fillable = ['college_id','college_name','phone','address','email'];
}
