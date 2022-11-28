<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenseType = ExpenseType::all();
        return view('backend.expense.index',compact('expenseType'));
    }

    public function getExpense(Request $request){
        if ($request->ajax()) {
            $data = Expense::latest()->with('getExpenseType')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('expense_type' , function($data){
                    return $data->getExpenseType->name;
                })
                ->editColumn('date', function($data){
                    $data = date('d-M-Y', strtotime($data->date));
                    return $data;
                })
                ->editColumn('description', function($data){
                    return '<button type="button" class="btn text-info" onclick="description('.$data->id.')">
                                <i class="fa fa-book"></i>
                            </button>';
                })
                ->addColumn('action', function($data){
                    $btn = '<button type="button" class="btn text-warning" onclick="editData('.$data->id.')">
                            <i class="fa fa-edit (alias)"></i>
                            </button>
                            <button type="button" class="btn text-danger" onclick="deleteData('.$data->id.')">
                            <i class="fa fa-trash-o"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['action','description'])
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
            'expense_type_id'  => 'required|min:1',
            'amount'    => 'required|min:1',
            'date'    => 'required|date',
            'description'    => 'nullable',
        ]);
        $date = str_replace('/', '-', $request->date);

        $input = $request->all();
        $input['date'] = Carbon::parse($date)->format('Y-m-d');
        $data = Expense::create($input);

        return response()->json($data);
    }


    public function show($id)
    {
        $data = Expense::find($id);
        return response()->json($data);
    }


    public function edit($id)
    {
        $data = Expense::find($id);
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'expense_type_id'  => 'required|min:1',
            'amount'    => 'required|min:1',
            'date'    => 'required',
            'description'    => 'nullable',
        ]);
        $date = str_replace('/', '-', $request->date);

        $input = $request->all();
        $input['date'] = Carbon::parse($date)->format('Y-m-d');
        $data = Expense::find($id)->update($input);

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Expense::find($id)->delete();
        return response()->json($data);
    }
}
