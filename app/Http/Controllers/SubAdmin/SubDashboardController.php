<?php

namespace App\Http\Controllers\SubAdmin;

use App\User;
use App\Models\Manage;
use App\Models\Departments;
use App\Models\Event;
use App\Models\Students;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;



class SubDashboardController extends Controller
{
    public function index()
    {
        
        return view('subadmin.userprofiles');
           
    }

    public function allusers()
    {
        $users = User::select('*')
        ->where('usertype','student')
        ->Where('usertype','faculty')
        ->Where('usertype','hod')
        ->get();

        return view('subadmin.manageusers')->with('users',$users);


    }


    public function register(Request $request)
    {
        $users = new Manage();

        $users->Name = $request->input('Name');
        $users->Department = $request->input('Department');
        $users->Designation = $request->input('Designation');
        $users->Phone = $request->input('Phone');
        $users->Email = $request->input('Email');

        $users->save();

        return redirect('/manageusers')->with('status','Your data is Registered');
    }

 
    // Manage users section

    public function manage()
    {
        $users = User::select('*')
        ->where('usertype','subadmin')
        ->where('usertype','student')
        ->where('usertype','deptadmin')
        ->where('usertype','faculty')
        ->where('usertype','hod')
        ->where('usertype','principal')
        ->get();
        return view('subadmin.manageusers')->with('users',$users);
    }

    public function useredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('subadmin.user-edit')->with('users',$users);
    }

    public function userupdate(Request $request, $id)
    {
        $users = User::find($id);

        
        $users->usertype = $request->input('usertype');
        $users->department = $request->input('department');
        

        $users->update();

        return redirect('/manageusers')->with('status','Your data is Updated');
    }

    public function userdelete($id)
    {
        $registers = User::findOrFail($id);
        $registers->delete();

        return redirect('/manageusers')->with('status','Your data is Deleted');
    }



    //Student section
 
 
    public function students()
    {
        return view('subadmin.students');
    }


    public function studentsearch()
    {

        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CSE')
        ->get();

        

        return view('subadmin.student_search', ['users' => $users]);
    }

    public function studentupdate(Request $request, $id)
    {
        $users = User::find($id);

        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');

        $users->update();

        return redirect('/student-search')->with('status','Your data is Updated');
    }

    public function studentdelete($id)
    {
        $registers = User::findOrFail($id);
        $registers->delete();

        return redirect('/student_search')->with('status','Your data is Deleted');
    }


    public function studentlist()
    {
        return view('subadmin.student-list');
    }

    public function cselist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CSE')
        ->get();

        

        return view('subadmin.manageusers', ['users' => $users]);
    }

    public function ecelist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','ECE')
        ->get();

        

        return view('subadmin.manageusers', ['users' => $users]);
    }


    public function eeelist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','EEE')
        ->get();

        

        return view('subadmin.manageusers', ['users' => $users]);
    }

    public function cvlist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CV')
        ->get();

        

        return view('subadmin.manageusers', ['users' => $users]);
    }

    public function melist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','ME')
        ->get();

        

        return view('subadmin.manageusers', ['users' => $users]);
    }

    public function mbalist()
    {
        
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','MBA')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }
    

    //Faculty List

    public function facultylist()
    {
        return view('subadmin.faculty-list');
    }

    public function csefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CSE')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }

    public function ecefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','ECE')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }


    public function eeefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','EEE')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }

    public function cvfacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CV')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }

    public function mefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','ME')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }

    public function basicfacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','Basic Sci')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }

    public function mbafacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','MBA')
        ->get();

        

        return view('subadmin.search', ['users' => $users]);
    }




    // Department section

    public function index1()
    {
        
        return view('subadmin.department');
          
    }

    public function add_department(Request $request)
    {
        $department = new Departments();

        $department->dept_id = $request->input('dept_id');
        $department->dept_name = $request->input('dept_name');

        $department->save();

        return redirect('/departmentlist')->with('status','Department Added');
    }



    // Calender section

    public function index2()
    {
        return view('subadmin.createevent');
    }

    public function store(Request $request) 
    {
        $event= new Event();
        $event->title=$request->input('title');
        $event->start_date=$request->input('startdate');
        $event->end_date=$request->input('enddate');
        $event->save();
        return redirect('/subcalender')->with('success', 'Event has been added');
    }   
    
    public function calender()
    {
        $events = [];
        $data = Event::all();
        if($data->count())
        { 
            foreach ($data as $key => $value) 
            {
                $events[] = Calendar::event(
                $value->title,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.'+1 day'),
                null,
                            // Add color
                [
                    'color' => '#ffcccc',
                    'textColor' => '#000000',
                    'font-weight' => '700',
                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('subadmin.calender', compact('calendar'));
    }


    public function deleteevent()
    {
        $events = Event::select('*')
        ->get();

        return view('subadmin.delete-event', ['events' => $events]);
    }

    public function removeevent($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();

        return redirect('/delete-event')->with('status','Event is Deleted');
    }


    public function userprofile()
    {
        return view ('subadmin.userprofile');
    }

    // Dashboard section

    //Total count of students

    public function student_count()
    {
        $users=DB::table(‘users’)->count();
           

           return view('subadmin.student-count', ['users' => $users]);
    }

    public function edit_userprofile()
    {
        return view('subadmin.subadmin-user-profile');
    }


    public function register_users(Request $request)
    {
        $users = new User();

        $users->college_id = $request->input('college_id');
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->address = $request->input('address');
        $users->username = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->secondary_role = $request->input('secondary_role');
        $users->email = $request->input('email');
        $users->dept_id = $request->input('dept_id');
        $users->password = Hash::make($request->input('password'));
        $users->save();
        
        return redirect('/subadmin/register_users')->with('status','New User Registered');
    }
}
