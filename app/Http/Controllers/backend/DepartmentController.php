<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $pageTitle = 'Department Management';
        return view('backend.department.index', compact('pageTitle'));
    }

    public function getDepartment(){
        $data = Department::latest()->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $data = Department::create($request->all());
        return response()->json($data);
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
