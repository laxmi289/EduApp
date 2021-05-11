<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;


class calendarController extends Controller
{
    public function show()
    {
        // $events = Event::all();
        $events = Event::orderBy('start_date','ASC')->get();
        return view('student.calendar')->with('events',$events);
    }
}
