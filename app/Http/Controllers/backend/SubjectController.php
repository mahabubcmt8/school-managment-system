<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        $class = Classes::oldest()->get();
        $pageTitle = 'Subject Management';
        return view('backend.subject.index', compact('class', 'pageTitle'));
    }

    public function getAllSubject(Request $request)
    {
        if ($request->ajax()) {
            $data = Subject::latest()->with('classes')->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('classes', function($data){
                    $class = $data->classes->class_name;
                    return $class;
                })
                ->addColumn('action', function($data){
                    $btn = '<button type="button" class="btn text-info" onclick="viewData('.$data->id.')">
                            <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn text-warning" onclick="editData('.$data->id.')">
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
        $data = Subject::with('classes')->find($id);
        return response()->json($data);
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
