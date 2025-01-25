<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Group;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{

    public function filterRead(){
        try{
            $activities = Activity::all();
            $groups = Group::all();
            return view('staff.teacher.attendance.filter_read', ['activities' => $activities, 'groups' => $groups]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showRead(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',
                'activity_id' => 'required',
                'day' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            $day = $request->day;
            $group = DB::table('groups')->where('id', $request->group_id)->get();
            $activity = DB::table('activities')->where('id', $request->activity_id)->get();
            $attendances = Attendance::where('group_id', $request->group_id)->where('activity_id', $request->activity_id)->where('day', $request->day)->with('student')->get();

            return view('staff.teacher.attendance.read',  ['attendances' => $attendances, 'group' => $group, 'activity' => $activity, 'day' => $day]);
        } catch( Exception $e){
             return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }

    public function filterCreate(){
        try{
            $activities = Activity::all();
            $groups = Group::all();
            return view('staff.teacher.attendance.filter_create', ['activities' => $activities, 'groups' => $groups]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showCreate(Request $request){
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
            $activity = DB::table('activities')->where('id', $request->activity_id)->get();
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

    }




    public function update(Request $request){
        try {
            $presensi = $request->input('presensi');

            foreach ($presensi as $data) {
                Attendance::where('id', $data['attendance_id'])->update([
                    'status' => $data['status'],
                ]);
            }

            return response()->json(['message' => 'Presensi berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request){
        try {
            $presensi = $request->input('presensi');

            foreach ($presensi as $data) {
                Attendance::where('id', $data['attendance_id'])->delete();
            }

            return response()->json(['message' => 'Presensi berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function filterReport(){
        try{
            $activities = Activity::all();
            $groups = Group::all();
            return view('staff.teacher.attendance.filter_report', ['activities' => $activities, 'groups' => $groups]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function report(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',
                'activity_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }



            $attendances = Attendance::whereBetween('day', [$request->start_date, $request->end_date])->where('group_id', $request->group_id)->where('activity_id', $request->activity_id)->with('student')->orderBy('day', 'asc')->get();

            $reportMap = [];
            foreach ($attendances as $at) {
                if (!isset($reportMap[$at->student_id])) {

                $reportMap[$at->student_id] = [
                    'name' => $at->student->name,
                    'hadir' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                    'alpha' => 0
                ];
                }

                // Update value berdasarkan status
                if ($at->status == 'hadir') {
                    $reportMap[$at->student_id]['hadir'] += 1;
                } else if ($at->status == 'sakit') {
                    $reportMap[$at->student_id]['sakit'] += 1;
                } else if ($at->status == 'izin') {
                    $reportMap[$at->student_id]['izin'] += 1;
                } else if ($at->status == 'alpha') {
                    $reportMap[$at->student_id]['alpha'] += 1;
                }

            }

            if ($request->get('export')== 'pdf'){
                $pdf = Pdf::loadView('staff.teacher.attendance.report_template',  ['reportMap' => $reportMap, 'group' => $attendances[0]->group->name, 'activity' => $attendances[0]->activity->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date, 'group_id' => $request->group_id, 'activity_id' => $request->activity_id]);
                return $pdf->download('laporan-presensi.pdf');
            }




            return view('staff.teacher.attendance.report', ['reportMap' => $reportMap, 'group' => $attendances[0]->group->name, 'activity' => $attendances[0]->activity->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date, 'group_id' => $request->group_id, 'activity_id' => $request->activity_id], );
        } catch( Exception $e){
             return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }




}
