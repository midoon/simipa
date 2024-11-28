<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    public function index(){
        $schedules = Schedule::all();
        $teachers = Teacher::all();
        $groups = Group::all();
        return view('admin.schedule.index', ['schedules' => $schedules, 'teachers' => $teachers, 'groups' => $groups]);
    }
}
