<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminTeacherController extends Controller
{
    public function index(){

        $teachers = Teacher::paginate(10);
        return view('admin.teacher.index', ['teachers' => $teachers]);
    }

    public function store(Request $request){
        $roles = $request->roles ?? ['guru'];

         $validator = Validator::make($request->all(),[
            'name' => 'required',
            'nik' => 'required',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

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

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'nik' => 'required',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

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

    public function downloadTemplate(){
        try {
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=teacher_template.csv"
            ];

            $columns = ['name', 'nik', 'gender',];

            $callback = function () use ($columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (Exception $e){
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengunduh template.']);
        }
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('file')->getRealPath(), 'r');
        $header = fgetcsv($file);

        $data = [];
        while ($row = fgetcsv($file)) {
            $data[] = [
                'name' => $row[0],
                'nik' => $row[1],
                'gender' => $row[2],
                'role' => ['guru'],
            ];
        }
        fclose($file);


        // filter for duplicate nik and gender validation

        foreach ($data as $teacher) {
            $validator = Validator::make($teacher,[
                'name' => 'required',
                'nik' => 'required|numeric',
                'gender' => 'required|in:perempuan,laki-laki'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            if (Teacher::where('nik', $teacher['nik'])->exists()) {
                return back()->withErrors(['guru' => "NIK: $teacher[nik] sudah terdaftar."]);
            }
        }

        DB::transaction(function () use ($data) {
            foreach ($data as $teacher) {
                Teacher::create($teacher);
            }
        });

        return back()->with('success', 'Data siswa berhasil diimport!');
    }
}
