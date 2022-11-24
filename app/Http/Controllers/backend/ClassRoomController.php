<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('backend.class-room.index');
    }

    public function getClassRoom(Request $request){
        if ($request->ajax()) {
            $data = ClassRoom::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $btn = '<button type="button" class="btn text-warning" onclick="editData('.$data->id.')">
                            <i class="fa fa-edit (alias)"></i>
                            </button>
                            <button type="button" class="btn text-danger" onclick="deleteData('.$data->id.')">
                            <i class="fa fa-trash-o"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
