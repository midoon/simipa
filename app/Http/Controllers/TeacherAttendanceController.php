<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{
    public function createInit(Request $request){

        try{
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',
                'activity_id' => 'required',
                'day' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $group = DB::table('groups')->where('id', $request->group_id)->get();
            $activity = DB::table('activities')->where('id', $request->group_id)->get();
            $students = DB::table('students')->where('group_id', $request->group_id)->get();
            return view('staff.teacher.attendance.create', ['students' => $students, 'group' => $group, 'activity' => $activity, 'day' => $request->day]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }


}
