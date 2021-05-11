<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Colleges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Support\Facades\Hash;
 

class DashboardController extends Controller
{
    public function registered() 
    {

        // $users = User::all(); 
        $users = User::select('*')
        ->where('usertype','subadmin')
        ->get();
        return view('admin.register_first')->with('users',$users);
    } 
 
    
    public function registeredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.register-edit')->with('users',$users);
    }

    public function registerupdate(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->update();

        return redirect('/manage-users')->with('status','Your data is Updated');
    }

    public function registerdelete($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/manage-users')->with('status','Your data is Deleted');
    }

    //User profile

    public function userprofile()
    {
        return view('admin.admin-user-profile');
    }

    public function store(Request $request)
    {
        $users = new User();

        $users->collegename = $request->input('collegename');
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->username = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->save();
        
        return redirect('/registerusers')->with('status','New User Registered');
    }

    //Registering colleges

    public function add_college(Request $request)
    {
        $college = new Colleges();

        $college->college_id = $request->input('college_id');
        $college->college_name = $request->input('college_name');
        $college->phone = $request->input('phone');
        $college->address = $request->input('address');
        $college->email = $request->input('email');

        $college->save();

        return redirect('/register-colleges')->with('status','New College Registered');

    }
 

    //Registering College Admin

    public function add_college_admin(Request $request)
    {
        $users = new User();

        $users->college_id = $request->input('college_id');
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->address = $request->input('address');
        $users->email = $request->input('email');
        $users->username = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->password = Hash::make($request->input('password'));

        $users->save();

        return redirect('/register_college_admin')->with('status','New College Admin Registered');

    }


}
