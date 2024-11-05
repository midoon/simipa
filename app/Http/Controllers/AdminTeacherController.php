<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function index(){
        return view('admin.teacher');
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
}
