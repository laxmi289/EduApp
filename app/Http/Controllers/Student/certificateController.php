<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class certificateController extends Controller
{
    public function show()
    {
        $certificates=DB::table('achievements')
        ->where('achievements.username',auth()->user()->username)
        ->get();
        return view('student.certificate')->with('certificates',$certificates);
    }
}


