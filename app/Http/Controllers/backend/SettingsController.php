<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\File;

class SettingsController extends Controller
{
    Use File;

    public function index()
    {
        $settings = Settings::latest()->first();
        $pageTitle = 'System Settings';
        return view('backend.settings.index',compact('settings', 'pageTitle'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

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
        $this->validate($request, [
            'email'     => 'nullable|email|unique:users,email',
            'logo'      => 'mimes:jpeg,jpg,png,gif|nullable|max:10000',
            'favicon'   => 'mimes:jpeg,jpg,png,gif|nullable|max:10000',
        ]);

        $input = $request->all();

         // Logo ------------------
         if ($file = $request->file('logo')){
            $path = 'public/images/settings';
            $logo = $this->fileUpload($file,$path);
            $input['logo'] = $logo;
        }else{
            unset($input['logo']);
        }

        // Favicon ------------------
        if ($file = $request->file('favicon')){
            $path = 'public/images/settings';
            $favicon = $this->fileUpload($file,$path);
            $input['favicon'] = $favicon;
        }else{
            unset($input['favicon']);
        }

        Settings::find($id)->update($input);
        Toastr::success('User Updated Successfully!!', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
