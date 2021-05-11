<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'student';
    protected $fillable = ['name','department','email','phone','password'];
}
