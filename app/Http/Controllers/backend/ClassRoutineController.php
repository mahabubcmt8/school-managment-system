<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\User;
use App\Models\ClassRoutine;
use App\Models\Subject;
use App\Models\ClassRoutinePeriod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class ClassRoutineController extends Controller
{
    public function index()
    {
        $routine = ClassRoutinePeriod::with('getRoutine','subject','class_room','teacher')->get();
        $pageTitle = 'Routine Management';
        return view('backend.class-routine.index',compact('routine', 'pageTitle'));
    }

    public function create()
    {
        $class = Classes::oldest()->get();
        $class_room = ClassRoom::latest()->get();
        $subject = Subject::latest()->get();
        $user = User::latest()->get();
        $pageTitle = 'Routine Management';

        return view('backend.class-routine.create',compact('class','class_room','user','subject', 'pageTitle'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'class_id'      => 'required|integer|min:1',
        //     'section_id'    => 'required|integer|min:1',
        //     'subject_id'    => 'required|integer|min:1',
        //     'class_room_id' => 'required|integer|min:1',
        //     'teacher_id'    => 'required|integer|min:1',
        //     'day'           => 'required|min:1',
        //     'start_time'    => 'required|min:1',
        //     'end_time'      => 'required|min:1'
        // ]);


        $subject_id    = $request->subject_id;
        $class_room_id = $request->class_room_id;
        $teacher_id    = $request->teacher_id;
        $start_time    = $request->start_time;
        $end_time      = $request->end_time;

        $routine = new ClassRoutine();
        $routine->class_id    = $request->class_id;
        $routine->section_id = $request->section_id;
        $routine->day         = $request->day;
        $routine->save();



        for($i = 0; $i < count($subject_id); $i++){
            $datasave = [
                'routine_no'    => $routine->id,
                'subject_id'    => $subject_id[$i],
                'class_room_id' => $class_room_id[$i],
                'teacher_id'    => $teacher_id[$i],
                'start_time'    => $start_time[$i],
                'end_time'      => $end_time[$i],
            ];
            DB::table('class_routine_periods')->insert($datasave);
        }


        Toastr::success('Routine Creation Successfully!!', 'Success');
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

    function destroy($id)
    {
        //
    }
}
