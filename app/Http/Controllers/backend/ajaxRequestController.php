<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamSchedule;
use App\Models\Student;
use App\Models\Fees;

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

    public function getStudent($class_id, $section_id){
        $data = Student::where('class_id',$class_id)->where('section_id',$section_id)->get();
        return response()->json($data);
    }

    public function getFees($fees_type, $class , $section, $status){
        $data = Fees::where('fees_type_id',$fees_type)
                ->where('class_id', $class)
                ->where('section_id', $section)
                ->where('status', $status)
                ->with('student','getFeesType','classes','section')
                ->get();
        return response()->json($data);
    }

}
