<?php

namespace App\Http\Controllers\Hod;

use Datatables;
use App\User; 
use App\Models\Event; 
use App\Models\Subjects; 
use App\Models\Assigned_Subjects;
use App\Models\Leaves;
use App\Models\TimeTables;
use App\Models\SyllabusCopy;
use App\Models\IaTimeTable;

use App\Models\Classroom;


use Redirect,Response,Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class HodController extends Controller
{
    // public function facultycount()
    // {
    //     $usersCount = User::all()->count();
    //     return view('hod.hod_dashboard', compact('usersCount'));
    // }

    //User Profile

    public function my_profile()
    {
        return view('hod.my_profile');
    }


    //Department

    public function department()
    {
        return view('hod.department-details');
    }

      //Faculty
    
    public function csefacultylist()
    {
          
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CSE')
        ->get();
  
          
  
        return view('hod.department-list', ['users' => $users]);
    }

     
    //Student

    public function cselist()
    {
            
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CSE')
        ->get();
    
            
    
        return view('hod.department-list', ['users' => $users]);
    }

    
    // Manage Faculties

    public function managefaculties()
    {
        $users = User::select('*')
        ->where('usertype','faculty')
        ->orwhere('usertype','hod')
        ->where('dept_id','like','%CSE%')
        ->get();
    
        return view('hod.manage-faculties', ['users' => $users]);  
    }


    //Assign faculties
   

    public function view_subjects()
    {

        $users = User::select(['username','name'])
            ->where('usertype','faculty')
            ->orwhere('usertype','hod')
            ->orwhere('secondary_role','hod')
            ->orwhere('secondary_role','faculty')
            ->where('dept_id','like','%CSE%')
            ->get();

        $subjects = Subjects::select('*')
                    ->get();

        return view('hod.assign-subjects',['subjects' => $subjects,'users' => $users]);
    }

    public function subject_assigned(Request $request)
    {
        $assigned_subjects = new Assigned_Subjects();
     
        $assigned_subjects->faculty_id = $request->input('faculty_id');
        $assigned_subjects->sub_code = $request->input('sub_code');

        $assigned_subjects->save();

        return redirect('/view-all-subjects')->with('status','Subject assigned successfully !');
    }


    
    //Approve section

    //Leaves

    public function approveleave()
    {
        return view('hod.approveleave');
    }

    public function leavelist()
    {
          
        $leaves = Leaves::select('*')
        ->where('department','CSE')
        ->where('responded','no')
        ->get();
  
        return view('hod.approveleave', ['leaves' => $leaves]);
    }

    public function leaveaction(Request $request, $id)
    {
        $users = User::find($id);

        $leaves->approved = $request->input('approved');

        $leaves->update();

        return redirect('/approve_leave')->with('status','Leave approved');
    } 

    //Timetables

    public function show_timetable()
    {
        return view('hod.approve_timetable');
    }

    public function approve_timetable()
    {
        $timetable = TimeTables::select('*')
            ->where('approval','pending')
            ->get();
    
        return view('hod.approve_timetable', ['timetable' => $timetable]);
    }

    // public function update_approval(Request $request, $id)
    // {
    //     $timetable = TimeTables::findOrFail($id);
    //     return view('hod.approve_timetable')->with('timetable',$timetable);
    // }

    public function approve_timetable_response(Request $request, $id)
    {
        $timetable = TimeTables::find($id);
        $timetable->approval = $request->input('approval');
        $timetable->update();

        return redirect('/approve_timetable')->with('status','Approved successfully !');
    }


    // Ia Timetable

    public function show_ia_timetable()
    {
        return view('hod.approve_ia_timetable');
    }

    public function approve_ia_timetable()
    {
        $ia_timetable = IaTimeTable::select('*')
            ->where('approval','pending')
            ->get();
    
        return view('hod.approve_ia_timetable', ['ia_timetable' => $ia_timetable]);
    }

    public function approve_ia_timetable_response(Request $request, $id)
    {
        $ia_timetable = IaTimeTable::find($id);
        $ia_timetable->approval = $request->input('approval');
        $ia_timetable->update();

        return redirect('/approve_ia_timetable')->with('status','IA Timetable Approved successfully !');
    }

    
    // Syllabus Copy

    public function show_syllabus_copy()
    {
        return view('hod.approve_syllabuscopy');
    }

    public function approve_syllabus_copy()
    {
        $syllabus_copy = SyllabusCopy::select('*')
            ->where('approval','pending')
            ->get();
    
        return view('hod.approve_syllabuscopy', ['syllabus_copy' => $syllabus_copy]);
    }

    public function approve_syllabus_copy_response(Request $request, $id)
    {
        $syllabus_copy = SyllabusCopy::find($id);
        $syllabus_copy->approval = $request->input('approval');
        $syllabus_copy->update();

        return redirect('/approve_syllabus_copy')->with('status','Syllabus Copy Approved successfully !');
    }

    public function test()
    {
        return view('hod.test');
    }
    // public function action()
    // {
    //     return view('hod.leave-action');
    // }

  
    //Apply Leaves Section

    public function leave()
    {
        return view('hod.leave');
    }

    public function applyleave(Request $request)
    {
        $leaves = new Leaves();
        
        $leaves->username = $request->input('username');
        $leaves->name = $request->input('name');
        $leaves->department = $request->input('department');
        $leaves->from_date = $request->input('from_date');
        $leaves->to_date = $request->input('to_date');
        $leaves->leave_reason = $request->input('leave_reason');
        $leaves->leave_details = $request->input('leave_details');

        $leaves->save();

        return redirect('/leave')->with('status','Leave applied successfully');
    }

    
    //Classes

    public function create_class()
    {
        return view('hod.create_class');
    }

    public function add_class(Request $request)
    {
        $classroom = new Classroom();

        $classroom->faculty_id = $request->input('faculty_id');
        $classroom->class_id = str_random(5);
        $classroom->sub_code = $request->input('sub_code');

        $classroom->save();

        return redirect('/hod_create_class')->with('status','Class created successfully');
    }

    public function classes()
    {
        return view('hod.hodclasses');
    }

    public function show_classes()
    {
        $classroom = DB::table('subjects')
        ->join('classroom', 'classroom.sub_code', 'subjects.sub_code')
        ->join('assigned_subjects','assigned_subjects.sub_code','subjects.sub_code')
        ->where('assigned_subjects.faculty_id',auth()->user()->username)
        ->get();

        // $classroom = DB::table('subjects')
        // ->join('assigned_subjects','assigned_subjects.sub_code','subjects.sub_code')
        // ->where('assigned_subjects.faculty_id',auth()->user()->username)
        // ->get();
  
        return view('hod.hodclasses', ['classroom' => $classroom]);
    }

    public function class_details()
    {
        return view('hod.class_details');
    }

    public function add_assignment()
    {
        return view('hod.hod_addassignment');
    }
    

    // Attendance 

    public function attendance()
    {
        return view('hod.attendance');
    }

    public function attendance_list()
    {
        $users = User::select('*')
                    ->where('usertype','student')
                    ->where('department','CSE')
                    ->get();

        return view('hod.attendance', ['users' => $users]);
    }

    //Timetable 

    public function timetable()
    {
        return view('hod.timetable');
    }


    //Calender

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
        return view('hod.calender', compact('calendar'));
    }

}
