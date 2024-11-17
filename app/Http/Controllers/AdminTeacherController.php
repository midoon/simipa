<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTeacherController extends Controller
{
    public function index(){

        $teachers = Teacher::all();
        return view('admin.teacher.index', ['teachers' => $teachers]);
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
                 return back()->withErrors(['guru' => "NIK: $request->nik sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.']);
        }

    }

    public function destroy($teacherId){

        try{
            $existData = [];

            if (DB::table('schedules')->where('teacher_id', $teacherId)->exists()) {
                array_push($existData,'jadwal');
            }

             if (DB::table('teacher_accounts')->where('teacher_id', $teacherId)->exists()) {
                DB::table('teacher_accounts')->delete($teacherId);
            }

            if (count($existData) != 0) {
                return back()->withErrors(['guru' =>"Guru yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }

            DB::table('teachers')->delete($teacherId);
            return redirect("/admin/teacher");
        } catch (Exception  $e){
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }

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
                 return back()->withErrors(['guru' => "NIK: $request->nik sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }

    }
}
