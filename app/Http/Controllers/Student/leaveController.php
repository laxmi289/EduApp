<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class leaveController extends Controller
{
    public function show()
    {
        $leaves=DB::table('leaves')
        ->where('leaves.username',auth()->user()->username)
        ->get();
        return view('student.leave')->with('leaves',$leaves);
    }
    public function store(Request $request)
    {
        
        $leaves = new Leave;
        $leaves->usn = $request->input('username');
        $leaves->fromdate = $request->input('fromdate');
        $leaves->todate = $request->input('todate');
        $leaves->reason = $request->input('reason');
        $leaves->leave_details = $request->input('leave_details');

        $leaves->save();
        return redirect('/applyleave')->with('status','Leave Applied');
    }
}
