<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Helpers\File;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    use File;

    public function index()
    {
        $students = Student::with('classes','section')->latest()->get();
        return view('backend.student.index',compact('students'));
    }


    public function create()
    {
        $Classes = Classes::all();
        return view('backend.student.create',compact('Classes'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|max:24',
            'email'             => 'nullable|email|min:3',
            'phone'             => 'nullable|min:3',
            'username'          => 'required|min:4|max:36',
            'roll_no'           => 'required|min:1',
            'dob'               => 'required|date',
            'registration_no'   => 'nullable',
            'class_id'          => 'required|integer|min:1',
            'section_id'        => 'required|integer|min:1',
            'section_id'        => 'required|integer|min:1',
            'picture'           => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'password'        => 'required|same:confirm-password',
        ]);
        $dob = str_replace('/', '-', $request->dob);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['dob'] = Carbon::parse($dob)->format('Y-m-d');

        // Profile Picture ------------------
        if ($file = $request->file('picture')){
            $path = 'public/images/students';
            $profile_pic = $this->fileUpload($file,$path);
            $input['picture'] = $profile_pic;
        }else{
            $input['picture'] = null;
        }

        $student = Student::create($input);
        Toastr::success('Student Creation Successfully!!', 'Success');
        return redirect()->route('students.index');


    }


    public function show($id)
    {
        $student = Student::find($id);
        return view('backend.student.show',compact('student'));
    }


    public function edit($id)
    {
        $Classes = Classes::all();
        $student = Student::find($id);
        return view('backend.student.edit',compact('Classes','student'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'              => 'required|max:24',
            'email'             => 'nullable|email|min:3',
            'phone'             => 'nullable|min:3',
            'id_no'          => 'required|min:4|max:36',
            'roll_no'           => 'required|min:1',
            'dob'               => 'required|date',
            'registration_no'   => 'nullable',
            'class_id'          => 'required|integer|min:1',
            'section_id'        => 'required|integer|min:1',
            'section_id'        => 'required|integer|min:1',
            'picture'           => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'password'        => 'required|same:confirm-password',
        ]);
        $dob = str_replace('/', '-', $request->dob);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['dob'] = Carbon::parse($dob)->format('Y-m-d');

        // Profile Picture ------------------
        if ($file = $request->file('picture')){
            $path = 'public/images/students';
            $profile_pic = $this->fileUpload($file,$path);
            $input['picture'] = $profile_pic;
        }else{
            unset($input['picture']);
        }

        $student = Student::find($id)->update($input);
        Toastr::success('Student Updated Successfully!!', 'Success');
        return redirect()->route('students.index');
    }


    public function destroy($id)
    {
        $student = Student::find($id)->delete();
        return redirect()->route('students.index');
        Toastr::success('Student Deleted Successfully!!', 'Success');
    }
}
