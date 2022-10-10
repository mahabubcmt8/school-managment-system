<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenseType = ExpenseType::all();
        return view('backend.expense.index',compact('expenseType'));
    }

    public function getExpense(){
        $data = Expense::with('getExpenseType')->latest()->get();
        return response()->json($data);
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
        //
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
