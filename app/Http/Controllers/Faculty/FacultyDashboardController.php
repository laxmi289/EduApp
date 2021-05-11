<?php

namespace App\Http\Controllers\Faculty;

use App\User; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Event; 
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class FacultyDashboardController extends Controller
{
    public function index()
    {
        return view('faculty.faculty_dashboard');
    }

    public function my_profile()
    {
        return view('faculty.my_profile');
    }
    
    /* Students */

   /*  public function students()
    {
        return view('faculty.students');
    }
     */

    // Manage students

    public function manage_students()
    {
        $users = User::select('*')
        ->where('usertype','student')
        ->where('department','like','CSE')
        ->get();
    
        return view('faculty.students', ['users' => $users]);  
    }

    // Lesson Plan

    public function lesson_plan()
    {
        return view('faculty.lesson_plan');
    }

    /* Classes */

    public function classes()
    {
        return view('faculty.facultyclasses');
    }
    
   
    public function class_details()
    {
        return view('faculty.class_details');
    }

    public function add_assignment()
    {
        return view('faculty.faculty_addassignment');
    }
   
    public function add_quiz()
    {
        return view('faculty.faculty_quiz');
    }

    //Leaves

    public function faculty_apply_leave(){
        return view('faculty.leave');
    }
    
    // Calendar

   /*  
    public function view_faculty_calender()
    {
        return view('faculty.view_faculty_calender');
    } */

    public function view_faculty_calender()
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
        return view('faculty.view_faculty_calender', compact('calendar'));
    }

    // public function profile(){
    //     return view('faculty.profile');
    // }

    public function change_password()
    {
        return view('faculty.change-password');
    }

    public function personal_details(){
        return view('faculty.personal_details');
    }

    public function education_details(){
        return view('faculty.education_details');
    }

    public function experience_details(){
        return view('faculty.experience_details');
    }

    public function publications(){
        return view('faculty.publications');
    }

    public function certifications(){
        return view('faculty.certifications');
    }

    public function patents(){
        return view('faculty.patent');
    }
}
