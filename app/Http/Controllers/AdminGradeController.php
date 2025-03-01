<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AdminGradeController extends Controller
{
    public function index(){
        $groups = Group::all();
        $grades = Grade::all();
        return view('admin.grade.index',[
            'groups' => $groups,
            'grades' => $grades
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try{
            Grade::create([
                'name' => $request->name
            ]);
            return redirect('/admin/grade');
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['kelas' => "kelas: $request->name sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }

    }


    public function destroy($kelasId){
         try{
            $existData = [];

            if (DB::table('groups')->where('grade_id', $kelasId)->exists()) {
                array_push($existData,'rombel');
            }

            if (DB::table('subjects')->where('grade_id', $kelasId)->exists()){
                array_push($existData,'rombel');
            }

            if (count($existData) != 0) {
                return back()->withErrors(['kelas' =>"Kelas yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)])->withInput();
            }
            DB::table('grades')->delete($kelasId);
            return redirect('/admin/grade');
        } catch (QueryException $e){
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat hapus data: $msg"])->withInput();
        }

    }

    public function update(Request $request, $kelasId){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        try {
             DB::table('grades')->where('id', $kelasId)->update([
                'name' => $request->name,
            ]);
             return redirect("/admin/grade");
        } catch( QueryException $e) {
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['kelas' => "kelas: $request->name sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }
    }

    public function downloadTemplate(){
        try {
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=grade_template.csv"
            ];

            $columns = ['name',];

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
            ];
        }
        fclose($file);


        // filter for duplicate nik and gender validation

        foreach ($data as $grade) {
            $validator = Validator::make($grade,[
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            if (Grade::where('name', $grade['name'])->exists()) {
                return back()->withErrors(['grade' => "name: $grade[name] sudah terdaftar."]);
            }
        }

        DB::transaction(function () use ($data) {
            foreach ($data as $teacher) {
                Grade::create($teacher);
            }
        });

        return back()->with('success', 'Data siswa berhasil diimport!');
    }
}
