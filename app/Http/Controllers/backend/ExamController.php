<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exam.index');
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('start_date', function($data){
                    $start_date = date('d-M-Y', strtotime($data->start_date));
                    return $start_date;
                })
                ->editColumn('end_date', function($data){
                    $end_date = date('d-M-Y', strtotime($data->end_date));
                    return $end_date;
                })
                ->editColumn('status' , function($data){
                    if($data->status == 1){
                        $status = "Complete";
                    }elseif ($data->status == 0) {
                        $status = "Incomplete";
                    }
                    return $status;
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
        $exam = Exam::find($id);
        return response()->json($exam);
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
