<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Collection\save;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class dashboardController extends Controller
{
    public function display()
    {
        
        $users=DB::table('users')
        ->join('studentprofile','studentprofile.username','users.username')
        ->where('users.username',auth()->user()->username)
        ->get();
        return view('student.dashboard')->with('users',$users);
    }

    public function profileedit(Request $request)
    {
        $users=DB::table('users')
        ->join('studentprofile','studentprofile.username','users.username')
        ->where('users.username',auth()->user()->username)
        ->get();
        
        return view('student.profile_update')->with('users',$users);
    }
    public function uploadprofile(Request $request,$username)
    {   

        // $users = new User();
        $users=DB::table('users')
        ->join('studentprofile','studentprofile.username','users.username')
        ->where('users.username',auth()->user()->username)
        ->get();

        // $request->file('profile_image')
        // ->store('profile_image');
        // return back()
        //     ->with('success','You have successfully upload image.');


        // $request->validate([
        //     'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
  
        // $imageName = time().'.'.$request->profile_image->extension();  
   
        // $request->profile_image->move(public_path('images'), $imageName);
   
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName);
   

        // return view('student.profile_update')->with('users',$users);

        if($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/employee', $filename);
            $users->profile_image = $filename;
        } else {
            return $request;
            $users->profile_image = '';
        }
        DB::update('update users set profile_image = ?',[$profile_image]);
        return view('student.profile_update')->with('users',$users);
        
        }
    }

//     public function profileupdate(Request $request,$usn)
//     {
//         $users=User::find($username);
//         $users->name = $request->input('name');
//         $users->phone = $request->input('phone');
//         $users->father_name = $request->input('father_name');
//         $users->mother_name = $request->input('mother_name');
//         $users->parents_number = $request->input('parents_number');
//         $users->address = $request->input('address');
//         $users->email = $request->input('email');
//         $users->sslc_marks = $request->input('sslc_marks');
//         $users->pu_marks = $request->input('pu_marks');
//         $users->diploma_marks = $request->input('diploma_marks');
       
//         $users->update();

//         return redirect('/studentdashboard')->with('status','Your Data is Updated');
//     }
  
// }
