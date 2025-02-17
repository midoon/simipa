<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        try {
            $cStudent = Student::count();
            $cTeacher = Teacher::count();
            $cTeacherAccount = DB::table('teachers')->where('account', true)->count();
            $paidFee = DB::table('fees')->sum('paid_amount');
            $totalFee =DB::table('fees')->sum('amount');
            return view('admin.dashboard', compact('cStudent', 'cTeacher', 'cTeacherAccount', 'paidFee', 'totalFee'));
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }
}
