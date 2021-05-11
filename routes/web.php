<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','admin']], function()
{

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

     




    // Pagination and serach

    Route::get('/role-register', 'UsersController@index');

    Route::get('users-list', 'UsersController@usersList'); 


    //User Profile

    Route::get('/admin-user-profile','Admin\DashboardController@userprofile');


    //Manage users

    Route::get('/register-admin','Admin\DashboardController@registeradmin');


    Route::get('/manage-users','Admin\DashboardController@registered');
    
    Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');

    Route::get('/role-register-update/{id}','Admin\DashboardController@registerupdate');

    Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');



    Route::get('/abouts','Admin\AboutusController@index');

    Route::post('/save-aboutus','Admin\AboutusController@store');
    
    Route::get('/about-us/{id}','Admin\AboutusController@edit');

    Route::put('aboutus-update/{id}','Admin\AboutusController@update');

    Route::delete('about-us-delete/{id}','Admin\AboutusController@delete');

    // Register colleges

    Route::get('/register-colleges', function () {
        return view('admin.register-colleges');
    });

    Route::post('/college_register','Admin\DashboardController@add_college');

    Route::get('/register-users', function () {
        return view('admin.register-users');
    });

    //Register college admins

    Route::post('/register_college_admin','Admin\DashboardController@add_college_admin');


    Route::post('/storeregisteredusers','Admin\DashboardController@store');    
});



// Sub Admin Dashboard

Route::get('/home', 'HomeController@subadmin')->name('home');


Route::group(['middleware' => ['auth','subadmin']], function() 
{
    
    Route::get('/subdashboard', function () {
        return view('subadmin.dashboard');
    }); 

    // Route::get('/userprofiles','SubAdmin\SubDashboardController@index');

    // Route::post('/userprofiles','SubAdmin\SubDashboardController@register');


    // register new users

    Route::get('/subadminregisterusers', function () {
        return view('subAdmin.registerusers');
    });
    Route::post('/subadmin/register_users','Subadmin\SubDashboardController@register_users');


    Route::get('/manageusers','SubAdmin\SubDashboardController@allusers');


    Route::get('/user-edit/{id}','SubAdmin\SubDashboardController@useredit');


    Route::get('/user-update/{id}','SubAdmin\SubDashboardController@userupdate');


    Route::delete('/user-delete/{id}','SubAdmin\SubDashboardController@userdelete');


    
    //Department section


    Route::get('/departmentlist','SubAdmin\SubDashboardController@index1');
    
    Route::post('/departmentlist','SubAdmin\SubDashboardController@add_department');



    //Calender Section
    

    Route::get('/subcalender','SubAdmin\SubDashboardController@index2');

    Route::post('/eventadd','SubAdmin\SubDashboardController@store');

    Route::get('/event','SubAdmin\SubDashboardController@calender');

    Route::get('/calender-view','SubAdmin\SubDashboardController@calender');

    Route::get('/delete-event','SubAdmin\SubDashboardController@deleteevent');

    Route::delete('/remove-event/{id}','SubAdmin\SubDashboardController@removeevent');
    


    //Student details update and delete

 
    Route::get('/students','SubAdmin\SubDashboardController@students');

    Route::get('/search','SubAdmin\SubDashboardController@search');

    Route::get('/student-update/{id}','SubAdmin\SubDashboardController@studentupdate');

    Route::delete('/student-delete/{id}','SubAdmin\SubDashboardController@userdelete');



    //Department wise student filtering

    Route::get('/student-list','SubAdmin\SubDashboardController@studentlist');

    Route::post('/students/cse','SubAdmin\SubDashboardController@cselist');
    Route::post('/students/ece','SubAdmin\SubDashboardController@ecelist');
    Route::post('/students/eee','SubAdmin\SubDashboardController@eeelist');
    Route::post('/students/cv','SubAdmin\SubDashboardController@cvlist');
    Route::post('/students/me','SubAdmin\SubDashboardController@melist');
    Route::post('/students/mba','SubAdmin\SubDashboardController@mbalist');

    

    //Department wise faculty filtering

    Route::get('/faculty-list','SubAdmin\SubDashboardController@facultylist');

    Route::post('/faculty/cse','SubAdmin\SubDashboardController@csefacultylist');
    Route::post('/faculty/ece','SubAdmin\SubDashboardController@ecefacultylist');
    Route::post('/faculty/eee','SubAdmin\SubDashboardController@eeefacultylist');
    Route::post('/faculty/cv','SubAdmin\SubDashboardController@cvfacultylist');
    Route::post('/faculty/me','SubAdmin\SubDashboardController@mefacultylist');
    Route::post('/faculty/bs','SubAdmin\SubDashboardController@basicfacultylist');
    Route::post('/faculty/mba','SubAdmin\SubDashboardController@mbafacultylist');


    //User profile

    Route::get('/subadmin-user-profile','SubAdmin\SubDashboardController@edit_userprofile');

    //Count of students
    Route::get('/count','SubAdmin\SubDashboardController@student_count');


});


// Route::get('users', 'UsersController@index');

// Route::get('users-list', 'UsersController@usersList'); 

 

//Principal Dasbboard

Route::get('/home', 'HomeController@principal')->name('home');


Route::group(['middleware' => ['auth','principal']], function() 
{
    
    Route::get('/principal_dashboard', function () {
        return view('principal.principal_dashboard');
    });

    //User Profile
    Route::get('/principal_profile','Principal\PrincipalDashboardController@my_profile');


    //Department Section
    Route::get('/department-details','Principal\PrincipalDashboardController@department');

    Route::get('/department/faculty','Principal\PrincipalDashboardController@departmentdetails');
    
    Route::post('/department/cse','Principal\PrincipalDashboardController@csefacultylist');
    Route::post('/department/ece','Principal\PrincipalDashboardController@ecefacultylist');
    Route::post('/department/eee','Principal\PrincipalDashboardController@eeefacultylist');
    Route::post('/department/cv','Principal\PrincipalDashboardController@cvfacultylist');
    Route::post('/department/me','Principal\PrincipalDashboardController@mefacultylist');
    Route::post('/department/bs','Principal\PrincipalDashboardController@basicfacultylist');
    Route::post('/department/mba','Principal\PrincipalDashboardController@mbafacultylist');


    Route::get('/department/student','Principal\PrincipalDashboardController@student');

    Route::post('/cse-students','Principal\PrincipalDashboardController@cselist');
    Route::post('/ece-students','Principal\PrincipalDashboardController@ecelist');
    Route::post('/eee-students','Principal\PrincipalDashboardController@eeelist');
    Route::post('/cv-students','Principal\PrincipalDashboardController@cvlist');
    Route::post('/me-students','Principal\PrincipalDashboardController@melist');
    Route::post('/mba-students','Principal\PrincipalDashboardController@mbalist');

    // Calender Section
    Route::get('/calender-views','Principal\PrincipalDashboardController@calender');

});



//HOD Dashboard

Route::get('/home', 'HomeController@hod')->name('home');


Route::group(['middleware' => ['auth','hod']], function() 
{
    
    Route::get('/hod_dashboard', function () {
        return view('hod.hod_dashboard');
    });


    Route::get('/count','Hod\HodController@facultycount');


    //User Profile Section
    Route::get('/hod_profile','Hod\HodController@my_profile');



    //Department Section
    Route::get('/departments','Hod\HodController@department');

    Route::get('/department/cse','Hod\HodController@csefacultylist');

    Route::get('/students/cse','Hod\HodController@cselist');



    //Assign faculty

    // Route::get('/manage-faculties','Hod\HodController@managefaculties');

    Route::get('/view-all-subjects','Hod\HodController@view_subjects');


    Route::post('/subjects_assigned','Hod\HodController@subject_assigned');



    //Approve Section

    //Leave

    Route::get('/approve_leave','Hod\HodController@approveleave');

    Route::get('/approve_leave','Hod\HodController@leavelist');

    Route::put('/leave_action_select/{id}','Hod\HodController@leaveaction');


    //Timetable

    Route::get('/approve_timetable','Hod\HodController@show_timetable');

    Route::get('/approve_timetable','Hod\HodController@approve_timetable');

    Route::post('/approval_response/{id}','Hod\HodController@approve_timetable_response');


    //IA time table

    Route::get('/approve_ia_timetable','Hod\HodController@show_ia_timetable');

    Route::get('/approve_ia_timetable','Hod\HodController@approve_ia_timetable');

    Route::post('/approval_response_ia_timetable/{id}','Hod\HodController@approve_ia_timetable_response');


    //Syllabus copy

    Route::get('/approve_syllabus_copy','Hod\HodController@show_syllabus_copy');

    Route::get('/approve_syllabus_copy','Hod\HodController@approve_syllabus_copy');

    Route::post('/approval_response_syllabus_copy/{id}','Hod\HodController@approve_syllabus_copy_response');






    //Apply Leave Section

    Route::get('/leave','Hod\HodController@leave');

    Route::post('/leave','Hod\HodController@applyleave');



    //Classes section

    Route::get('/hod_create_class','Hod\HodController@create_class');

    Route::post('/hod_add_class','Hod\HodController@add_class');


    Route::get('/hod_classes','Hod\HodController@classes');

    Route::get('/hod_classes','Hod\HodController@show_classes');


    Route::get('/hod_class_details/{class_id}','Hod\HodController@class_details');

    Route::get('/hod_addassignment','Hod\HodController@add_assignment');


    //Attendance section

    Route::get('/attendance','Hod\HodController@attendance');

    Route::get('/attendance','Hod\HodController@attendance_list');


    //Timetable section

    Route::get('/hodtimetable','Hod\HodController@timetable');


    // Calender Section
    Route::get('/view-calender','Hod\HodController@calender');

    

    
});
//Department Admin dashboard

Route::get('/home', 'HomeController@deptadmin')->name('home');



Route::group(['middleware' => ['auth','deptadmin']], function() 
{
    
    Route::get('/deptadmin_dashboard', function () {
        return view('deptadmin.deptadmin_dashboard');
    });


    // User Profile

    Route::get('/deptadmin_profile','DeptAdmin\DeptAdminController@my_profile');

    //Department and Subject Details Section

    Route::get('/department/cse','DeptAdmin\DeptAdminController@csefacultylist');

    Route::get('/students/cse','DeptAdmin\DeptAdminController@cselist');


    //Subject details section

    Route::get('/add-subjects','DeptAdmin\DeptAdminController@subject');

    Route::post('/add_new_subject','DeptAdmin\DeptAdminController@add_subject');

    Route::get('/subject-details','DeptAdmin\DeptAdminController@subject_details');

    Route::get('/view-subjects','DeptAdmin\DeptAdminController@viewsubjects');


    //Add student and parent section

    Route::get('/add-students','DeptAdmin\DeptAdminController@student');

    Route::post('/register_new_student','DeptAdmin\DeptAdminController@register_students');

    Route::post('/register_new_parent','DeptAdmin\DeptAdminController@register_parents');


    //Calender Section

    // Route::get('/calender','DeptAdmin\DeptAdminController@calender');

    // Route::post('/calender','DeptAdmin\DeptAdminController@store');

    // Route::get('/view_calender','DeptAdmin\DeptAdminController@calender_view');

    Route::get('/calender','DeptAdmin\DeptAdminController@index2');

    Route::post('/event/add','DeptAdmin\DeptAdminController@store');

    Route::get('/event','DeptAdmin\DeptAdminController@calender');

    Route::get('/view_calender','DeptAdmin\DeptAdminController@calender');

    Route::get('/college-calender','DeptAdmin\DeptAdminController@college_calender');

    Route::get('/modify_event','DeptAdmin\DeptAdminController@modify_event');

    Route::get('/update_event/{id}','DeptAdmin\DeptAdminController@update_event');

    Route::get('/event_edit_modify/{id}','DeptAdmin\DeptAdminController@event_edit_modify');


    //Upload section

    Route::resource('add-timetable', 'FileUploads\TimeTableUploadController');
    Route::resource('add-ia-timetable', 'FileUploads\IaTimeTableUploadController');
    Route::resource('add-syllabus-copy', 'FileUploads\SyllabusCopyUploadController');

    Route::get('view_timetable','DeptAdmin\DeptAdminController@view_timetable');
    Route::get('view_timetable','DeptAdmin\DeptAdminController@show_timetable');

    Route::get('view_ia_timetable','DeptAdmin\DeptAdminController@view_ia_timetable');
    Route::get('view_ia_timetable','DeptAdmin\DeptAdminController@show_ia_timetable');

    Route::get('view_syllabus_copy','DeptAdmin\DeptAdminController@view_syllabus_copy');
    Route::get('view_syllabus_copy','DeptAdmin\DeptAdminController@show_syllabus_copy');

});
 


// Faculty Dashboard


Route::get('/home', 'HomeController@faculty')->name('home');


Route::group(['middleware' => ['auth','faculty']], function() 
{
    
    Route::get('/faculty_dashboard', function () {
        return view('faculty.faculty_dashboard');
    }); 

    Route::get('/my_profile', 'Faculty\FacultyDashboardController@my_profile' );

    /* student */
    
    Route::get('/students', 'Faculty\FacultyDashboardController@manage_students' );


    //Lesson Plan

    Route::get('/faculty_lesson_plan', 'Faculty\FacultyDashboardController@lesson_plan' );


    /* Classes */

    Route::get('/facultyclasses', 'Faculty\FacultyDashboardController@classes' );    

    Route::get('/facultyclass_details', 'Faculty\FacultyDashboardController@class_details' ); 
    
    Route::get('/faculty_addassignment', 'Faculty\FacultyDashboardController@add_assignment' ); 
    
    Route::get('/faculty_quiz', 'Faculty\FacultyDashboardController@add_quiz' ); 

    
    /* applyleave */

    Route::get('/faculty_apply_leave', 'Faculty\FacultyDashboardController@faculty_apply_leave' ); 

    Route::post('/faculty_apply_leave', 'Faculty\FacultyDashboardController@faculty_leave' ); 


    /* Calender */


    Route::get('/view_faculty_calender', 'Faculty\FacultyDashboardController@view_faculty_calender' ); 


    // Profile

    // Route::get('/profile', 'Faculty\FacultyDashboardController@profile' );

    Route::get('/change_password', 'Faculty\FacultyDashboardController@change_password' );

    Route::get('/personal_details', 'Faculty\FacultyDashboardController@personal_details' );

    Route::get('/education_details', 'Faculty\FacultyDashboardController@education_details' );

    Route::get('/experience_details', 'Faculty\FacultyDashboardController@experience_details' );

    Route::get('/publications', 'Faculty\FacultyDashboardController@publications' );

    Route::get('/certifications', 'Faculty\FacultyDashboardController@certifications' );

    Route::get('/patents', 'Faculty\FacultyDashboardController@patents' );
});



//student dashboard
Route::group(['middleware' => ['auth','student']], function() {
    Route::get('/studentdashboard', 'Student\dashboardController@display');
    Route::get('/calendar', 'Student\calendarController@show');
    Route::get('/profile-edit','Student\dashboardController@profileedit');
    Route::put('/update-profile/{usn}','Student\dashboardController@profileupdate');
    // Route::post('/uploadprofile','Student\dashboardController@uploadprofile');
    Route::post('/uploadprofile/{id}','Student\dashboardController@uploadprofile');
    Route::get('/class-tt', function () {
        return view('student.classtimetable');        
    });
    Route::get('/internals-tt', function () {
        return view('student.internalstimetable');        
    });
    Route::get('/selectsubject', function () {
        return view('student.selectattendancesubject');        
    });
    Route::get('/applyleave','Student\leaveController@show');
    Route::post('/save-leave','Student\leaveController@store');
    Route::get('/certificate','Student\certificateController@show');

});

//student dashboard
Route::get('/parentsdashboard', function () {
    return view('parents.studentprofile');        
});



