<?php

namespace App\Http\Controllers\Student;
use App\DocterCertificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocterCerificateController extends Controller
{
    public function store(Request $request)
    {
        $aboutus = new Abouts;
        
        $aboutus->file = $request->input('file');
        $aboutus->save();
        Session::flash('statuscode','success');
        return redirect('/doccertificate')->with('status','Data Added for Docter certificatevp');
    }
}
