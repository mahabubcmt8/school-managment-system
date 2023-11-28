<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Section;
use Yajra\DataTables\DataTables;

class SectionController extends Controller
{

    public function index()
    {
        $class = Classes::oldest()->get();
        $pageTitle = 'Section Management';
        return view('backend.section.index', compact('class', 'pageTitle'));
    }

    public function getSections(Request $request)
    {
        if ($request->ajax()) {
            $data = Section::with('classes')->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('classes', function($data){
                    $class = $data->classes->class_name . " (" . $data->classes->class_numaric_name . ")";
                    return $class;
                })
                ->addColumn('action', function($data){
                    $btn = '<button type="button" class="btn btn-outline-warning btn-sm" onclick="editData('.$data->id.')">
                            <i class="fa fa-edit (alias)"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData('.$data->id.')">
                            <i class="fa-solid fa-trash-can"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
