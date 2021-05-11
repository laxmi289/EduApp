<?php

namespace App\Http\Controllers\DeptAdmin;

use App\User; 
use App\Models\Subjects;
use App\Models\Event; 
use App\Models\Parents; 
use App\Models\TimeTables;
use App\Models\IaTimeTable;
use App\Models\SyllabusCopy;

use Crypt;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class DeptAdminController extends Controller
{

    //User profile

    public function my_profile(){
        return view('deptadmin.my_profile');
    }

    // Department and Subject details section

    public function subject_details()
    {
        return view('deptadmin.subject-details');
    }

    public function csefacultylist()
    {
          
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CSE')
        ->get(); 
  
          
  
        return view('deptadmin.department-list', ['users' => $users]);
    }

    public function cselist()
    {
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CSE')
        ->get();
    
        return view('deptadmin.department-list', ['users' => $users]);
    }

    public function subject()
    {
        return view('deptadmin.add-subjects');
    }

    public function add_subject(Request $request)
    {
        $subjects = new Subjects();

        $subjects->dept_id = $request->input('dept_id');
        $subjects->sub_code = $request->input('sub_code');
        $subjects->sub_name = $request->input('sub_name');
        $subjects->sem = $request->input('sem');
        $subjects->scheme = $request->input('scheme');
        $subjects->year = $request->input('year');
        $subjects->credits = $request->input('credits');

        $subjects->save();

        return redirect('/add-subjects
        ')->with('status','Subject added successfully');
    }



    public function viewsubjects(Request $request)
    {
        $scheme = Input::get('scheme');
        $sem = Input::get('sem');

        $subjects = Subjects::where('scheme','LIKE','%'.$scheme.'%')
                    ->where('sem','LIKE','%'.$sem.'%')
                    ->get();

        return view('deptadmin.view-subjects', ['subjects' => $subjects]);
    }


    //Add students section

    public function student() 
    {
        return view('deptadmin.add-students');
    }

    public function register_students(Request $request)
    {
        $student = new User();

        $student->college_id = $request->input('college_id');
        $student->dept_id = $request->input('dept_id');
        $student->usertype = $request->input('usertype');
        $student->username = $request->input('username');
        $student->name = $request->input('name');
        $student->phone = $request->input('phone');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->password = Hash::make($request->input('password'));

        $student->save();

        return redirect('/add-students')->with('status','Student added successfully');
    }

    public function register_parents(Request $request)
    {
        $parent = new Parents();

        $parent->student_username = $request->input('student_username');
        $parent->parent_name = $request->input('parent_name');
        $parent->parent_email = $request->input('parent_email');
        $parent->phone = $request->input('phone');
        $parent->password = Hash::make($request->input('password'));

        $parent->save();

        return redirect('/add-students')->with('status','Parent added successfully');
    }


    //Upload 

    //Time table

    public function timetable()
    {
        return view('deptadmin.add-timetable');
    } 

    public function ia_timetable()
    {
        return view('deptadmin.add-ia-timetable');
    } 

    public function syllabus_copy()
    {
        return view('deptadmin.add-syllabus-copy');
    } 



    //Calender Section

    public function index2()
    {
        return view('deptadmin.createevent');
    }

    public function store(Request $request) 
    {
        $event= new Event();
        $event->eventtype=$request->input('eventtype');
        $event->title=$request->input('title');
        $event->start_date=$request->input('startdate');
        $event->end_date=$request->input('enddate');
        $event->save();
        return redirect('event')->with('success', 'Event has been added');
    }

    public function calender()
    {
        $events = [];
        $data = Event::select('*')
            ->where('eventtype','Department Event')
            ->get();

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
        return view('deptadmin.calender', compact('calendar'));
    }

    public function college_calender()
    {
        $events = [];
        $data = Event::select('*')
            ->where('eventtype','College Event')
            ->get();

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
        return view('deptadmin.calender', compact('calendar'));
    }

    public function modify_event()
    {
        
        $events = Event::select('*')
        ->where('eventtype','Department Event')
        ->get();

        return view('deptadmin.modify-event', ['events' => $events]);
    }

    public function edit_event()
    {
        return view('deptadmin.update_event');
    }

    public function update_event(Request $request, $id)
    {
        $events = Event::findOrFail($id);  
        return view('deptadmin.update_event')->with('events',$events);
    }

    public function event_edit_modify(Request $request, $id)
    {
        $events = Event::find($id);
        $events->title = $request->input('title');
        $events->start_date = $request->input('start_date');
        $events->end_date = $request->input('end_date');
        $events->update();

        return redirect('/modify_event')->with('status','Your data is Updated');
    }


    //View uploads

    //Time table

    public function view_timetable()
    {
        return view('deptadmin.view_timetable');
    }

    public function show_timetable()
    {
        $timetable = TimeTables::select('*')
        ->get();
    
        return view('deptadmin.view_timetable', ['timetable' => $timetable]);
    }

    //IA Time Table

    public function view_ia_timetable()
    {
        return view('deptadmin.view_ia_timetable');
    }

    public function show_ia_timetable()
    {
        $ia_timetable = IaTimeTable::select('*')
        ->get();
    
        return view('deptadmin.view_ia_timetable', ['ia_timetable' => $ia_timetable]);
    }


    //Syllabus copy

    public function view_syllabus_copy()
    {
        return view('deptadmin.view_syllabuscopy');
    }
    
    public function show_syllabus_copy()
    {
        $syllabus_copy = SyllabusCopy::select('*')
        ->get();
    
        return view('deptadmin.view_syllabuscopy', ['syllabus_copy' => $syllabus_copy]);
    }
}
