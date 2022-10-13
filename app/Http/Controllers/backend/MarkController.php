<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Classes;
use App\Models\Mark;
use Brian2694\Toastr\Facades\Toastr;

class MarkController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        $classes = Classes::all();

        return view('backend.mark.index',compact('exams','classes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_id'      => 'required|integer|min:1',
            'class_id'      => 'required|integer|min:1',
            'section_id'    => 'required|integer|min:1',
            'subject_id'    => 'required|integer|min:1',
        ]);
        $students = $request->student_id;
        if($students){
            for ($i=0; $i < count($students) ; $i++) {
                $data = new Mark();
                $data['exams_id']    = $request->exam_id;
                $data['class_id']   = $request->class_id;
                $data['section_id'] = $request->section_id;
                $data['subject_id'] = $request->subject_id;
                $data['student_id'] = $request->student_id[$i];
                $data['marks']      = $request->marks[$i];
                $data->save();
            }
        }
        Toastr::success('Student Mark Added successfull!!', 'Success');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function markedit(){
        $exams = Exam::all();
        $classes = Classes::all();
        return view('backend.mark.edit',compact('exams','classes'));
    }

    public function markupdate(Request $request)
    {
        $validated = $request->validate([
            'exam_id'      => 'required|integer|min:1',
            'class_id'      => 'required|integer|min:1',
            'section_id'    => 'required|integer|min:1',
            'subject_id'    => 'required|integer|min:1',
        ]);

        Mark::where('exams_id',$request->exam_id)
        ->where('class_id', $request->class_id)
        ->where('section_id', $request->section_id)
        ->where('subject_id', $request->subject_id)
        ->delete();

        $students = $request->student_id;
        if($students){
            for ($i=0; $i < count($students) ; $i++) {
                $data = new Mark();
                $data['exams_id']   = $request->exam_id;
                $data['class_id']   = $request->class_id;
                $data['section_id'] = $request->section_id;
                $data['subject_id'] = $request->subject_id;
                $data['student_id'] = $request->student_id[$i];
                $data['marks']      = $request->marks[$i];
                $data->save();
            }
        }
        Toastr::success('Mark updated successfull !!', 'Success');
        return redirect()->back();
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
