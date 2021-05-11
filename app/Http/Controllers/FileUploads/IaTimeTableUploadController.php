<?php

namespace App\Http\Controllers\FileUploads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IaTimeTable;

class IaTimeTableUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deptadmin.add-ia-timetable');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ia_timetable = new IaTimeTable();

        $ia_timetable->user_id = $request->input('user_id');
        $ia_timetable->dept_id = $request->input('dept_id');
        $ia_timetable->sem = $request->input('sem');
        $ia_timetable->scheme = $request->input('scheme');
        $ia_timetable->academic_year = $request->input('academic_year');

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/ia_timetable/', $filename);

            //see above line.. path is set.(uploads/appsetting/..)->which goes to public->then create
            //a folder->upload and appsetting, and it wil store the images in your file.

            $ia_timetable->file_path = $filename;
        } else {
            return $request;
            $ia_timetable->file_path = '';
        }
        $ia_timetable->save();

        return redirect('/add-ia-timetable/create')->with('status','Time table added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
