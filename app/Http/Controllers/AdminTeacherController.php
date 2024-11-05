<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTeacherController extends Controller
{
    public function index(){

        $teachers = Teacher::all();
        return view('admin.teacher', ['teachers' => $teachers]);
    }

    public function store(Request $request){
        $roles = $request->roles ?? ['guru'];

        $teacher = Teacher::create([
            'name' => $request->name,
            'role' => $roles,
            'nik' => $request->nik,
            'gender' => $request->gender,
        ]);



        return redirect("/admin/teacher");
    }

    public function destroy($teacherId){
        DB::table('teachers')->delete($teacherId);
        return redirect("/admin/teacher");
    }
}
