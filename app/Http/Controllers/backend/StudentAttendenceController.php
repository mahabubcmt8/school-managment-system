<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\StudentAttendence;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class StudentAttendenceController extends Controller
{

    public function index()
    {
        $students = Student::latest()->get();
        $class = Classes::all();
        return view('backend.student-attendence.index',compact('students','class'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
        ]);
        $students = $request->student_id;
        for ($i=0; $i < count($request->attendence) ; $i++) {
                $date = str_replace('/', '-', $request->date);
                $data = new StudentAttendence();
                $data['date']   =       Carbon::parse($date)->format('Y-m-d');
                $data['class_id'] = $request->class_id;
                $data['section_id'] = $request->section_id;
                $data['student_id'] =     $request->student_id[$i];
                $data['attendence'] =   $request->attendence[$i];
                $data->save();
            }

        Toastr::success('Attendence Saved Successfully !!');
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
