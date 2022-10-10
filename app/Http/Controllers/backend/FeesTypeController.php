<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesType;

class FeesTypeController extends Controller
{
    public function index()
    {
        return view('backend.fees-type.index');
    }

    public function getFeesType(){
        $data = FeesType::all();
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
        $data = FeesType::create($input);

        return response()->json($data);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = FeesType::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:1',
        ]);

        $input = $request->all();
        $data = FeesType::find($id)->update($input);

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = FeesType::find($id)->delete();
        return response()->json($data);
    }
}
