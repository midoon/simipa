<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminScheduleController extends Controller
{
    public function index(){
        $schedules = Schedule::all();
        $teachers = Teacher::all();
        $groups = Group::all();
        $subjects = Subject::all();
        return view('admin.schedule.index', ['schedules' => $schedules, 'teachers' => $teachers, 'groups' => $groups, 'subjects' => $subjects]);
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',
                'teacher_id' => 'required',
                'subject_id' => 'required',
                'day_of_week' => 'required',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            Schedule::create([
                'group_id' => $request->group_id,
                'teacher_id' => $request->teacher_id,
                'subject_id' => $request->subject_id,
                'day_of_week' => $request->day_of_week,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
            return redirect('/admin/schedule');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }
}
