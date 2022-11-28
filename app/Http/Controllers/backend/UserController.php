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
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use File;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->with('department')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('picture', function ($data) {
                    if ($data->profile_picture) {
                        $picutre = '<div class="profile-image mb-3">
                                    <img src="' . asset('storage/images/users/' . $data->profile_picture) . '" class="profile-avatar">
                                    </div>';
                    } else {
                        $picutre = '<div class="profile-image mb-3">
                                    <img src="' . asset('backend/assets/images/xs/avatar2.jpg') . '" class="profile-avatar">
                                    </div>';
                    }
                    return $picutre;
                })
                ->editColumn('department_id', function ($data) {
                    return $data->department->name;
                })
                ->editColumn('role', function ($data) {
                    if (!empty($data->getRoleNames())) {
                        foreach ($data->getRoleNames() as $v) {
                            return '<label class="badge badge-success">' . $v . '</label>';
                        }
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<div class="btn-group">
                            <a href="'. route('users.show', $data->id) .'" class="btn text-info">
                                <span class="sr-only">Edit</span><i class="fa fa-eye"></i>
                            </a>
                            <a href="'. route('users.edit', $data->id) .'" class="btn text-warning"
                                title="Edit">
                                <span class="sr-only">Edit</span><i class="fa fa-edit (alias)"></i>
                            </a>
                            <button type="button" class="btn text-danger" onclick="deleteData('.$data->id.')">
                            <i class="fa fa-trash-o"></i>
                            </button>
                        </div>';
                    return $btn;
                })
                ->rawColumns(['picture', 'role', 'action'])
                ->make(true);
        }
        return view('backend.users.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $department = Department::latest()->get();
        return view('backend.users.create', compact('roles', 'department'));
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



        $dob = str_replace('/', '-', $request->dob);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['dob'] = Carbon::parse($dob)->format('Y-m-d');

        // Profile Picture ------------------
        if ($file = $request->file('profile_picture')) {
            $path = 'public/images/users';
            $profile_pic = $this->fileUpload($file, $path);
            $input['profile_picture'] = $profile_pic;
        } else {
            $input['profile_picture'] = null;
        }

        // Resume ------------------
        if ($file = $request->file('resume')) {
            $path = 'public/document/users';
            $resume = $this->fileUpload($file, $path);
            $input['resume'] = $resume;
        } else {
            $input['resume'] = null;
        }

        // Joining Letter ------------------
        if ($file = $request->file('joining_letter')) {
            $path = 'public/document/users';
            $joining_letter = $this->fileUpload($file, $path);
            $input['joining_letter'] = $joining_letter;
        } else {
            $input['joining_letter'] = null;
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        Toastr::success('User Creation Successfully!!', 'Success');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $department = Department::latest()->get();

        return view('backend.users.edit', compact('user', 'roles', 'userRole', 'department'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'            => 'required|string|max:256|min:1',
            'email'           => 'required|email|unique:users,email,' . $id,
            'phone'           => 'required||min:11|numeric',
            'department_id'   => 'required',
            'gender'          => 'required|string|max:56|min:1',
            'dob'             => 'required|date',
            'profile_picture' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000',
            'resume'          => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'joining_letter'  => 'mimes:jpeg,jpg,png,pdf|nullable|max:10000',
            'roles'           => 'required'
        ]);

        $dob = str_replace('/', '-', $request->dob);

        $input = $request->all();
        $input['dob'] = Carbon::parse($dob)->format('Y-m-d');

        // Profile Picture ------------------
        if ($file = $request->file('profile_picture')) {
            $path = 'public/images/users';
            $profile_pic = $this->fileUpload($file, $path);
            $input['profile_picture'] = $profile_pic;
        } else {
            unset($input['profile_picture']);
        }

        // Resume ------------------
        if ($file = $request->file('resume')) {
            $path = 'public/document/users';
            $resume = $this->fileUpload($file, $path);
            $input['resume'] = $resume;
        } else {
            unset($input['resume']);
        }

        // Joining Letter ------------------
        if ($file = $request->file('joining_letter')) {
            $path = 'public/document/users';
            $joining_letter = $this->fileUpload($file, $path);
            $input['joining_letter'] = $joining_letter;
        } else {
            unset($input['joining_letter']);
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Toastr::success('User updated Successfully!!', 'Success');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $data = User::find($id)->delete();
        return response()->json($data);
    }
}
