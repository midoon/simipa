<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Database\QueryException;
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

        try {
            Teacher::create([
            'name' => $request->name,
            'role' => $roles,
            'nik' => $request->nik,
            'gender' => $request->gender,
        ]);
             return redirect("/admin/teacher");
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['nik' => "NIK: $request->nik sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }



        return redirect("/admin/teacher");
    }

    public function destroy($teacherId){
        DB::table('teachers')->delete($teacherId);
        return redirect("/admin/teacher");
    }

    public function update(Request $request, $teacherId){
        $roles = $request->roles ?? ['guru'];

        try {
            DB::table('teachers')->where('id', $teacherId)->update([
                'name' => $request->name,
                'role' => $roles,
                'nik' => $request->nik,
                'gender' => $request->gender,
            ]);
             return redirect("/admin/teacher");
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['nik' => "NIK: $request->nik sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }

    }
}
