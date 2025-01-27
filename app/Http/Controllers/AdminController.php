<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherAccount;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $cStudent = Student::count();
        $cTeacher = Teacher::count();
        $cTeacherAccount = TeacherAccount::count();
        return view('admin.dashboard', compact('cStudent', 'cTeacher', 'cTeacherAccount'));
    }
}
