<?php

namespace App\Http\Controllers;

use domain\Facades\StudentFacade;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
       // return view('pages.student.index');


        $response['students']=StudentFacade::all();
        return view('pages.student.index')->with($response);
    }

    public function store(Request $request){

         StudentFacade::store($request->all());
         return redirect()->back();
    }



}
