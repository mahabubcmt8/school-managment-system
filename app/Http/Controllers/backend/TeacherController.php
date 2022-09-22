<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Helpers\File;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    use File;

    public function index()
    {
        $teachers = Teacher::latest()->with('department')->get();
        return view('backend.teacher.index',compact('teachers'));
    }

    public function create()
    {
        $dept = Department::latest()->get();
        return view('backend.teacher.create',compact('dept'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:256|min:1',
            'email'           => 'required|email|max:128|min:1|unique:users',
            'phone'           => 'required||min:11|numeric',
            'department_id'   => 'required',
            'gender'          => 'required|string|max:56|min:1',
            'dob'             => 'required|date',
            'profile_picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'resume'          => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'joining_letter'  => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'password'        => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        // Profile Picture ------------------
        if ($file = $request->file('profile_picture')){
            $path = 'public/images/teacher';
            $profile_pic = $this->fileUpload($file,$path);
        }else{
            $profile_pic = '';
        }

        // Resume ------------------
        if ($file = $request->file('resume')){
            $path = 'public/document/teacher';
            $resume = $this->fileUpload($file,$path);
        }else{
            $resume = '';
        }

        // Joining Letter ------------------
        if ($file = $request->file('joining_letter')){
            $path = 'public/document/teacher';
            $joining_letter = $this->fileUpload($file,$path);
        }else{
            $joining_letter = '';
        }
        $date = str_replace('/', '-', $request->dob);

        // Get User ID
        $user = User::latest()->first()->id;

        $teacher = new Teacher();
        $teacher->user_id = $user + 1;
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->department_id = $request->department_id;
        $teacher->dob = Carbon::parse($date)->format('Y-m-d');
        $teacher->profile_picture = $profile_pic;
        $teacher->resume = $resume;
        $teacher->joining_letter = $joining_letter;
        $teacher->save();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Toastr::success('Teacher Creation Successfully!!', 'Success');
        return redirect()->route('teacher.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        $dept = Department::latest()->get();
        return view('backend.teacher.edit',compact('dept','teacher'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:256|min:1',
            'email'           => 'required|email|max:128|min:1',
            'phone'           => 'required||min:11|numeric',
            'department_id'   => 'required',
            'gender'          => 'required|string|max:56|min:1',
            'dob'             => 'required|date',
            'profile_picture' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000',
            'resume'          => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'joining_letter'  => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
        ]);

        // Profile Picture ------------------
        if ($file = $request->file('profile_picture')){
            $path = 'public/images/teacher';
            $profile_pic = $this->fileUpload($file,$path);
        }else{
            $profile_pic = $request->file('profile_picture');
        }

        // Resume ------------------
        if ($file = $request->file('resume')){
            $path = 'public/document/teacher';
            $resume = $this->fileUpload($file,$path);
        }else{
            $resume = $request->resume;
        }

        // Joining Letter ------------------
        if ($file = $request->file('joining_letter')){
            $path = 'public/document/teacher';
            $joining_letter = $this->fileUpload($file,$path);
        }else{
            $joining_letter = $request->joining_letter;
        }
        $date = str_replace('/', '-', $request->dob);

        $teacher = Teacher::find($request->teacher_id);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->department_id = $request->department_id;
        $teacher->dob = Carbon::parse($date)->format('Y-m-d');
        $teacher->profile_picture = $profile_pic;
        $teacher->resume = $resume;
        $teacher->joining_letter = $joining_letter;
        $teacher->save();
        $user = User::find($request->teacher_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Toastr::success('Teacher Updated Successfully!!', 'Success');
        return redirect()->route('teacher.index');
    }

    public function destroy($id)
    {
        $delete = Teacher::where('id', $id)->delete();
        Toastr::success('Teacher Deleted!!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back()->with('message','Deleted Successfully');
    }
}
