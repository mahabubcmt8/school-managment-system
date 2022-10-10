<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesType;
use App\Models\Classes;
use App\Models\Fees;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class FeesController extends Controller
{

    public function index()
    {
        $fees_type = FeesType::all();
        $Classes = Classes::all();
        return view('backend.fees.index',compact('fees_type','Classes'));
    }


    public function create()
    {
        $fees_type = FeesType::all();
        $Classes = Classes::all();
        return view('backend.fees.create',compact('fees_type','Classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fees_type_id'  => 'required|integer|min:1',
            'class_id'      => 'required|integer|min:1',
            'section_id'    => 'required|integer|min:1',
            'student_id'    => 'required|integer|min:1',
            'amount'        => 'required|min:1',
            'due_date'      =>  'required|date',
            'status'        => 'required|integer',
            'note'          => 'nullable',
        ]);

        $due_date = str_replace('/', '-', $request->due_date);
        $input = $request->all();
        $input['due_date'] = Carbon::parse($due_date)->format('Y-m-d');
        $data = Fees::create($input);

        Toastr::success('Fees Created!!', 'Success');
        return redirect()->route('fees.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = Fees::find($id)->delete();
        return redirect()->route('fees.index');
    }
}
