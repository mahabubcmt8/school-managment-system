<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ResultRule;

class ResultRuleController extends Controller
{

    public function index()
    {
        return view('backend.result-rule.index');
    }

    public function getResultRule(){
        $data = ResultRule::all();
        return response()->json($data);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|min:1',
            'gpa'       => 'required|min:1',
            'min_mark'  => 'required|min:1',
            'max_mark'  => 'required|min:1',
        ]);

        $input = $request->all();
        $data = ResultRule::create($input);

        Toastr::success('Result Rule Added!!', 'Success');
        return response()->json($data);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = ResultRule::find($id);
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'      => 'required|min:1',
            'gpa'       => 'required|min:1',
            'min_mark'  => 'required|min:1',
            'max_mark'  => 'required|min:1',
        ]);

        $input = $request->all();
        $data = ResultRule::find($id)->update($input);

        Toastr::success('Result Rule Updated!!', 'Success');
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = ResultRule::find($id)->delete();
        return response()->json($data);
    }
}
