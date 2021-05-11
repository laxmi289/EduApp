<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manage extends Model
{
    protected $table = 'registers';
    protected $fillable = ['Name','Department','Designation','Phone','Email'];
}
