<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exam.index');
    }

    public function getExamList()
    {
        $exam = Exam::latest()->get();
        return response()->json($exam);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:24|min:1',
            'start_date' => 'required',
            'end_date' => 'required',
            'note' => 'nullable',
        ]);

        $start_date = str_replace('/', '-', $request->start_date);
        $end_date = str_replace('/', '-', $request->end_date);

        $exam = new Exam();
        $exam->name        = $request->name;
        $exam->start_date  = Carbon::parse($start_date)->format('Y-m-d');
        $exam->end_date    = Carbon::parse($end_date)->format('Y-m-d');
        $exam->note        = $request->note;
        $exam->status      = $request->status;
        $exam->save();
        return response()->json($exam);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $exam = Exam::find($id);
        return response()->json($exam);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:24|min:1',
            'start_date' => 'required',
            'end_date' => 'required',
            'note' => 'nullable',
        ]);

        $start_date = str_replace('/', '-', $request->start_date);
        $end_date = str_replace('/', '-', $request->end_date);

        $exam = Exam::find($id);
        $exam->name        = $request->name;
        $exam->start_date  = Carbon::parse($start_date)->format('Y-m-d');
        $exam->end_date    = Carbon::parse($end_date)->format('Y-m-d');
        $exam->note        = $request->note;
        $exam->status      = $request->status;
        $exam->save();
        return response()->json($exam);
    }

    public function destroy($id)
    {
        $exam = Exam::find($id)->delete();
        return response()->json($exam);
    }
}
