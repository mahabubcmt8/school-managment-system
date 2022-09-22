<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Section;

class SectionController extends Controller
{

    public function index()
    {
        $class = Classes::oldest()->get();
        return view('backend.section.index', compact('class'));
    }

    public function getSections()
    {
        $data = Section::oldest()->with('classes')->get();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:24',
            'class_id' => 'required|max:24',
            'capacity' => 'required|max:24',
        ]);

        $data = Section::create($request->all());
        return response()->json($data);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Section::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:24',
            'class_id' => 'required|max:24',
            'capacity' => 'required|max:24',
        ]);
        $data = Section::find($id)->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data =  Section::find($id)->delete();
        return response()->json($data);
    }
}
