<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\ExamSchedule;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class ExamScheduleContorller extends Controller
{

    public function index()
    {
        $exam = Exam::latest()->get();
        $class= Classes::all();
        return view('backend.exam-schedule.index',compact('exam','class'));
    }


    public function create()
    {
        $exam = Exam::latest()->get();
        $class= Classes::all();
        $class_room= ClassRoom::all();
        return view('backend.exam-schedule.create',compact('exam','class','class_room'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_id' => 'required|integer|min:1',
            'class_id' => 'required|integer|min:1',
            'section_id' => 'required|integer|min:1',
            'class_room_id' => 'required|integer|min:1',
            'subject_id' => 'required|integer|min:1',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $exam_date = str_replace('/', '-', $request->exam_date);

        $input  = $request->all();
        $input['exam_date'] = Carbon::parse($exam_date)->format('Y-m-d');

        $exam_schedule = ExamSchedule::create($input);

        Toastr::success('Exam Schedule added Successfully!!', 'Success');
        return redirect()->route('exam-schedule.index');
        }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = ExamSchedule::find($id);
        $exam = Exam::latest()->get();
        $class= Classes::all();
        $class_room= ClassRoom::all();
        return view('backend.exam-schedule.edit',compact('data','exam','class','class_room'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'exam_id' => 'required|integer|min:1',
            'class_id' => 'required|integer|min:1',
            'section_id' => 'required|integer|min:1',
            'class_room_id' => 'required|integer|min:1',
            'subject_id' => 'required|integer|min:1',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $exam_date = str_replace('/', '-', $request->exam_date);

        $input  = $request->all();
        if($request->exam_date){
            $input['exam_date'] = Carbon::parse($exam_date)->format('Y-m-d');
        }else{
            unset($input['exam_date']);
        }

        $exam_schedule = ExamSchedule::find($id)->update($input);

        Toastr::success('Exam Schedule Updated Successfully!!', 'Success');
        return redirect()->route('exam-schedule.index');
    }


    public function destroy($id)
    {
        $data = ExamSchedule::find($id)->delete();

        Toastr::success('Exam Schedule Deleted!!', 'Warning');
        return redirect()->route('exam-schedule.index');
    }
}
