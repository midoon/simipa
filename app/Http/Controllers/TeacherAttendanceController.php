<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request){

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

    public function store(Request $request){
        try {
            $presensi = $request->input('presensi');

            foreach ($presensi as $data) {
                Attendance::create([
                    'student_id' => $data['student_id'],
                    'status' => $data['status'],
                    'activity_id' => $data['activity_id'],
                    'group_id' => $data['group_id'],
                    'day' => $data['day']
                ]);
            }

            return response()->json(['message' => 'Presensi berhasil disimpan!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
        // return response()->json(['message' => $request->all()]);
    }


}
