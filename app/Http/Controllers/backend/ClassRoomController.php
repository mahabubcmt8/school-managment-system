<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('backend.class-room.index');
    }

    public function getClassRoom(){
        $data = ClassRoom::latest()->get();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:256',
            'room_no' => 'required|min:1',
            'capacity' => 'required|min:1'
        ]);

        $data = ClassRoom::create($request->all());
        return response()->json($data);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = ClassRoom::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:256',
            'room_no' => 'required|min:1',
            'capacity' => 'required|min:1'
        ]);
        $data = ClassRoom::find($id)->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data =  ClassRoom::find($id)->delete();
        return response()->json($data);
    }
}
