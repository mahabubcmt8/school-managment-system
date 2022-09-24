<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Helpers\File;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    Use File;

    public function index(Request $request)
    {
        $users = User::latest()->with('department')->get();;
        return view('backend.users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $department = Department::latest()->get();
        return view('backend.users.create',compact('roles','department'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'            => 'required|string|max:256|min:1',
            'email'           => 'required|email|unique:users,email',
            'phone'           => 'required||min:11|numeric',
            'department_id'   => 'required',
            'gender'          => 'required|string|max:56|min:1',
            'dob'             => 'required|date',
            'profile_picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'resume'          => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'joining_letter'  => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'password'        => 'required|same:confirm-password',
            'roles'           => 'required'
        ]);

        // Profile Picture ------------------
        if ($file = $request->file('profile_picture')){
            $path = 'public/images/teacher';
            $profile_pic = $this->fileUpload($file,$path);
        }else{
            $profile_pic = '';
        }

        // Resume ------------------
        if ($file = $request->file('resume')){
            $path = 'public/document/users';
            $resume = $this->fileUpload($file,$path);
        }else{
            $resume = '';
        }

        // Joining Letter ------------------
        if ($file = $request->file('joining_letter')){
            $path = 'public/document/users';
            $joining_letter = $this->fileUpload($file,$path);
        }else{
            $joining_letter = '';
        }

        $dob = str_replace('/', '-', $request->dob);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['dob'] = Carbon::parse($dob)->format('Y-m-d');
        $input['profile_picture'] = $profile_pic;
        $input['resume'] = $resume;
        $input['joining_letter'] = $joining_letter;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        Toastr::success('Teacher Creation Successfully!!', 'Success');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('backend.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
