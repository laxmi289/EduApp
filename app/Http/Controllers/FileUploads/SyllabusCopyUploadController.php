<?php

namespace App\Http\Controllers\FileUploads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SyllabusCopy;

class SyllabusCopyUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deptadmin.add-syllabus-copy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $syllabus_copy = new SyllabusCopy();

        $syllabus_copy->user_id = $request->input('user_id');
        $syllabus_copy->dept_id = $request->input('dept_id');
        $syllabus_copy->sem = $request->input('sem');
        $syllabus_copy->scheme = $request->input('scheme');
        $syllabus_copy->academic_year = $request->input('academic_year');

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/syllabus_copy/', $filename);

            //see above line.. path is set.(uploads/appsetting/..)->which goes to public->then create
            //a folder->upload and appsetting, and it wil store the images in your file.

            $syllabus_copy->file_path = $filename;
        } else {
            return $request;
            $syllabus_copy->file_path = '';
        }
        $syllabus_copy->save();

        return redirect('/add-syllabus-copy/create')->with('status','Syllabus copy added successfully !');
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
