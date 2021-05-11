<?php 

namespace App\Http\Controllers\Principal;

use App\User;
use App\Models\Event; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class PrincipalDashboardController extends Controller
{

    //User section
    public function my_profile()
    {
        return view('principal.my_profile');
    }

    //Departments Section

    public function department()
    {
        return view('principal.department-details');
    }

    public function departmentdetails()
    {
        return view('principal.department');
    }

        //Faculty
    
    public function csefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CSE')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function ecefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','ECE')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function eeefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','EEE')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function cvfacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','CV')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function mefacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','ME')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function basicfacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','Basic Sci')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

    public function mbafacultylist()
    {
        
        $users = User::select('*')
        ->where('usertype','faculty')
        ->where('department','like','MBA')
        ->get();

        

        return view('principal.department-list', ['users' => $users]);
    }

        //Students

        public function student()
        {
        return view('principal.student'); 
        }

        public function cselist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','CSE')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }
    
        public function ecelist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','ECE')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }
    
    
        public function eeelist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','EEE')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }
    
        public function cvlist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','CV')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }
    
        public function melist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','ME')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }
    
        public function mbalist()
        {
            
            $users = User::select('*')
            ->where('usertype','student')
            ->where('department','like','MBA')
            ->get();
    
            
    
            return view('principal.department-list', ['users' => $users]);
        }


    // Calender Section

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
        return view('principal.calender', compact('calendar'));
    }
}
 