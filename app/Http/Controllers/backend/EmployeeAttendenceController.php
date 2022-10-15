<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeAttendence;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class EmployeeAttendenceController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('backend.employee-attendence.index',compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
        ]);
        $users = $request->users_id;
        for ($i=0; $i < count($request->attendence) ; $i++) {
                $date = str_replace('/', '-', $request->date);
                $data = new EmployeeAttendence();
                $data['date']   =       Carbon::parse($date)->format('Y-m-d');
                $data['users_id'] =     $request->users_id[$i];
                $data['attendence'] =   $request->attendence[$i];
                $data->save();
            }

        Toastr::success('Attendence Saved Successfully !!');
        return redirect()->back();
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
        //
    }
}
