<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if(Auth::user()->usertype == 'admin')
        {
            return 'dashboard';
        }
        else if(Auth::user()->usertype == 'subadmin')
        {
            return 'subdashboard';
        }
        else if(Auth::user()->usertype == 'principal')
        {
            return 'principal_dashboard';
        }
        else if(Auth::user()->usertype == 'hod')
        {
            return 'hod_dashboard';
        }
        else if(Auth::user()->usertype == 'faculty')
        {
            return 'faculty_dashboard';
        }
        else if(Auth::user()->usertype == 'student')
        {
            return 'studentdashboard';
        }
        else if(Auth::user()->usertype == 'deptadmin')
        {
            return 'deptadmin_dashboard';
        }
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
