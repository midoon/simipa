<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminScheduleController extends Controller
{
    public function index(Request $request){

        try{
            $query = $request->query();
            $scheduleQuery = Schedule::query()->with(['group', 'teacher', 'subject']);

            $scheduleQuery->when(isset($query['group_id']), function($q) use ($query){
                $q->where('group_id', $query['group_id']);
            });

            $scheduleQuery->when(isset($query['teacher_id']), function($q) use ($query){
                $q->where('teacher_id', $query['teacher_id']);
            });

            $scheduleQuery->when(isset($query['day_of_week']), function($q) use ($query){
                $q->where('day_of_week', $query['day_of_week']);
            });

            $scheduleQuery->when(isset($query['name']), function ($q) use ($query) {
               $q->whereHas('subject', function($subQuery) use ($query){
                $subQuery->where('name', 'like', '%' . $query['name'] . '%');
               });
            });

            $schedules = $scheduleQuery->get();
            $teachers = Teacher::all();
            $groups = Group::all();
            $subjects = Subject::all();
            return view('admin.schedule.index', ['schedules' => $schedules, 'teachers' => $teachers, 'groups' => $groups, 'subjects' => $subjects]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }


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

    public function destroy($scheduleId){
        try{
            DB::table('schedules')->delete($scheduleId);
            return redirect('/admin/schedule');
        } catch (Exception $e) {
            return back()->withErrors(['error' => "Terjadi kesalahan saat menghapus data: {$e->getMessage()}"]);
        }
    }

    public function update(Request $request, $scheduleId){
        try {
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

            DB::table('schedules')->where('id', $scheduleId)->update([
                'group_id' => $request->group_id,
                'teacher_id' => $request->teacher_id,
                'subject_id' => $request->subject_id,
                'day_of_week' => $request->day_of_week,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            return redirect('/admin/schedule');
        }catch(Exception $e){
              return back()->withErrors(['error' => "Terjadi kesalahan saat mengubah data: {$e->getMessage()}"]);
        }
    }
}
