<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminStudentController extends Controller
{
    //
    public function index(){
        $students = Student::all();
        $groups = Group::all();
        return view('admin.student.index', ['students' => $students, 'groups' => $groups]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'group_id' => 'required',
            'nisn' => 'required',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try{
            Student::create([
            'name' => $request->name,
            'group_id' => $request->group_id,
            'nisn' => $request->nisn,
            'gender' => $request->gender,
            ]);
            return redirect('/admin/student');
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['student' => "NISN: $request->nisn sudah terdaftar."]);
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.']);
        }
    }
}
