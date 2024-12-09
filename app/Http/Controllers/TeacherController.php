<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Schedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index(){
        try {
            $teacherId = session('teacher')['teacherId'];
            $today = Carbon::now()->isoFormat('dddd');
            $schedules = Schedule::where('day_of_week', strtolower($today))->when($teacherId, function ($query, $teacherId) {
                $query->where('teacher_id', $teacherId);
            })->orderBy('start_time', 'asc')->get();
            return view('staff.teacher.index', ['schedules' => $schedules]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showSchedule(){
        try{
            $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
            $teacherId = session('teacher')['teacherId'];
            $schedules =Schedule::where('teacher_id',$teacherId)->orderBy('start_time', 'asc')->get();
            return view('staff.teacher.schedule', ['schedules' => $schedules, 'days' => $days]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showAttendance(){
        try {
            $activities = Activity::all();
            $groups = Group::all();
            return view('staff.teacher.attendance.index', ['activities' => $activities, 'groups' => $groups]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showPayment(){
        return view('staff.teacher.payment.index');
    }
}
