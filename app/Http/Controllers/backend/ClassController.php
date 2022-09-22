<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.class.index');
    }

    public function getClasses(){
        $data = Classes::oldest()->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|max:24',
            'class_numaric_name' => 'required|max:24',
        ]);

        $data = Classes::create($request->all());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

     /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $data = Classes::find($id);
        return response()->json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'class_name' => 'required|max:24',
            'class_numaric_name' => 'required|max:24',
        ]);
        $data = Classes::find($id)->update($request->all());
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data =  Classes::find($id)->delete();
        return response()->json($data);
    }
}
