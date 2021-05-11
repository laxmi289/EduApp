<?php

namespace App\Http\Controllers\Admin;

use App\Models\Abouts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;

class AboutusController extends Controller
{
    public function index()
    {
        $aboutus = Abouts::paginate(25);
        return view('admin.aboutus') 
            ->with('aboutus',$aboutus);
    }

    public function store(Request $request) 
    { 
        $aboutus = new Abouts();

        $aboutus->title = $request->input('title');
        $aboutus->subtitle = $request->input('subtitle');
        $aboutus->description = $request->input('description');
    
        $aboutus->save();
        
        return redirect('/abouts')->with('status','Data added for About uS');
    }

    public function edit($id)
    {
        $aboutus = Abouts::findOrFail($id);

        return view('admin.abouts.edit')
            ->with('aboutus',$aboutus)
            ;
    }

    public function update(Request $request, $id)
    {
        $aboutus = Abouts::findOrFail($id);
        $aboutus->title = $request->input('title');
        $aboutus->subtitle = $request->input('subtitle');
        $aboutus->description = $request->input('description');
        $aboutus->update();

        return redirect('aboutus')->with('status','Data Updated for About Us');
    }


    public function delete($id)
    {
        $aboutus = Abouts::findOrFail($id);
        $aboutus->delete();

        return redirect('abouts')->with('status','Data Deleted for About Us');
    }
}
