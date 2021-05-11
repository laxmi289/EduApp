<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['dept_id','sub_code','sub_name','sem','scheme','year','credits'];
}
