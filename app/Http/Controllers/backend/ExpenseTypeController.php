<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseType;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        return view('backend.expense-type.index');
    }

    public function getExpenseType(){
        $data = ExpenseType::all();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:1',
        ]);

        $input = $request->all();
        $data = ExpenseType::create($input);

        return response()->json($data);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = ExpenseType::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:1',
        ]);

        $input = $request->all();
        $data = ExpenseType::find($id)->update($input);

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = ExpenseType::find($id)->delete();
        return response()->json($data);
    }
}
