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
        $roles = [];
        if ($request->roles == null){
            $roles[0] = "guru";
        } else {
            for ($i = 0; $i < count($request->roles); $i++){
                $roles[$i] = $request->roles[$i];
            }
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'password' => $request->password,
            'nik' => $request->nik,
            'gender' => $request->gender,
        ]);



        dd($teacher);




    }
}
