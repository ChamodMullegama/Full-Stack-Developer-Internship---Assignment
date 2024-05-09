<?php

namespace App\Http\Controllers;

use domain\Facades\StudentFacade;
use Illuminate\Http\Request;

class StudentController extends ParentController
{
    public function all()
    {
        return StudentFacade::all();
    }

    public function store(Request $request)
    {
        return StudentFacade::store($request->all());
    }

    public function delete($student_id)
    {
        return StudentFacade::delete($student_id);
    }

    public function status($student_id)
    {
        return StudentFacade::status($student_id);
    }

    public function get(Request $request)
    {
        return StudentFacade::get($request->student_id);
    }

    public function update(Request $request, $student_id)
    {
       return StudentFacade::update($request->all(), $student_id);
    }

}
