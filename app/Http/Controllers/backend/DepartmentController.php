<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('backend.department.index');
    }

    public function getDepartment(){
        $data = Department::latest()->get();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $data = Department::create($request->all());
        return response()->json($data);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Department::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:24',
        ]);
        $data = Department::find($id)->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data =  Department::find($id)->delete();
        return response()->json($data);
    }
}
