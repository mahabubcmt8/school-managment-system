<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;

class ajaxRequestController extends Controller
{
    public function getSection($id){
        $data  = Section::where('class_id', $id)->get();
        return response()->json($data);
    }

    public function getSubject($id){
        $data  = Subject::where('class_id', $id)->get();
        return response()->json($data);
    }
}
