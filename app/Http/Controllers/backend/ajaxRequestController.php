<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamSchedule;

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

    public function getExams($exam_id, $class_id, $section_id){
        $examSchedule = ExamSchedule::where('exam_id',$exam_id)
        ->where('class_id',$class_id)
        ->where('section_id',$section_id)
        ->with('exam','class_room','subject','section','class')
        ->get();
        return response()->json($examSchedule);
    }

}
