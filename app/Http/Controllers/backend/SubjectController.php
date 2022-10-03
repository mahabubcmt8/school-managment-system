<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $class = Classes::oldest()->get();
        return view('backend.subject.index', compact('class'));
    }

    public function getAllSubject()
    {
        $data = Subject::latest()->with('classes')->get();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|max:24',
            'name' => 'required|max:24',
            'code' => 'required|max:24',
            'type' => 'required|max:24',
            'total_mark' => 'required|max:24',
            'pass_mark' => 'required|max:24',
            'optional' => 'required'
        ]);
        $data = Subject::create($request->all());
        return response()->json($data);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Subject::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'class_id' => 'required|max:24',
            'name' => 'required|max:24',
            'code' => 'required|max:24',
            'type' => 'required|max:24',
            'total_mark' => 'required|max:24',
            'pass_mark' => 'required|max:24',
            'optional' => 'required'
        ]);
        $data = Subject::find($id)->update($request->all());
        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = Subject::find($id)->delete();
        return response()->json($data);
    }
}
