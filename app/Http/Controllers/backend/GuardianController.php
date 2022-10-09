<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Guardian;
use App\Helpers\File;
use Brian2694\Toastr\Facades\Toastr;


class GuardianController extends Controller
{
    Use File;

    public function index()
    {
        $guardians = Guardian::with('student')->latest()->get();
        return view('backend.guardians.index',compact('guardians'));
    }


    public function create()
    {
        $student = Student::all();
        return view('backend.guardians.create',compact('student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'    => 'required|integer|min:1',
            'fathers_name'  => 'nullable|string|min:1',
            'mothers_name'  => 'nullable|string|min:1',
            'fathers_email' => 'nullable|email|min:1',
            'mothers_email' => 'nullable|email|min:1',
            'fathers_phone' => 'nullable|min:1',
            'mothers_phone' => 'nullable|min:1',
            'fathers_photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'mothers_photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);


        $input = $request->all();
        // Fathers Photo ------------------
        if ($file = $request->file('fathers_photo')){
            $path = 'public/images/guardians';
            $fathers_photo = $this->fileUpload($file,$path);
            $input['fathers_photo'] = $fathers_photo;
        }else{
            $input['fathers_photo'] = null;
        }

        // Mothers Photo ------------------
        if ($file = $request->file('mothers_photo')){
            $path = 'public/images/guardians';
            $mothers_photo = $this->fileUpload($file,$path);
            $input['mothers_photo'] = $mothers_photo;
        }else{
            $input['mothers_photo'] = null;
        }

        $guardians = Guardian::create($input);

        Toastr::success('Guardians Creation Successfully!!', 'Success');
        return redirect()->route('guardians.index');
    }

    public function show($id)
    {
        $guardian = Guardian::find($id);
        return view('backend.guardians.show',compact('guardian'));
    }

    public function edit($id)
    {
        $guardian = Guardian::find($id);
        $student = Student::all();
        return view('backend.guardians.edit',compact('guardian','student'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id'    => 'required|integer|min:1',
            'fathers_name'  => 'nullable|string|min:1',
            'mothers_name'  => 'nullable|string|min:1',
            'fathers_email' => 'nullable|email|min:1',
            'mothers_email' => 'nullable|email|min:1',
            'fathers_phone' => 'nullable|min:1',
            'mothers_phone' => 'nullable|min:1',
            'fathers_photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'mothers_photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);


        $input = $request->all();
        // Fathers Photo ------------------
        if ($file = $request->file('fathers_photo')){
            $path = 'public/images/guardians';
            $fathers_photo = $this->fileUpload($file,$path);
            $input['fathers_photo'] = $fathers_photo;
        }else{
            unset($input['fathers_photo']);
        }

        // Mothers Photo ------------------
        if ($file = $request->file('mothers_photo')){
            $path = 'public/images/guardians';
            $mothers_photo = $this->fileUpload($file,$path);
            $input['mothers_photo'] = $mothers_photo;
        }else{
            unset($input['mothers_photo']);
        }

        $guardians = Guardian::find($id)->update($input);

        Toastr::success('Guardians Updated Successfully!!', 'Success');
        return redirect()->route('guardians.index');
    }

    public function destroy($id)
    {
        $guardians = Guardian::find($id)->delete();
        return redirect()->route('guardians.index');
    }
}
