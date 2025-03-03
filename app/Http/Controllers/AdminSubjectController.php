<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminSubjectController extends Controller
{
    public function index(Request $request){

        try{
            $query = $request->query();

            $subjectQuery = Subject::query()->with('grade');

            $subjectQuery->when(isset($query['grade_id']), function ($q) use ($query) {
                $q->where('grade_id', $query['grade_id']);
            });

            $subjectQuery->when(isset($query['name']), function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query['name'] . '%');
            });

            $subjects = $subjectQuery->get();
            $grades = Grade::all();
            return view('admin.subject.index', ['grades' => $grades, 'subjects' => $subjects]);

        } catch(Exception $e){
             return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }


    }

    public function store(Request $request) {
        try {
            $defaultDescription = $request->name;
            if ($request->description != null){
                $defaultDescription = $request->description;
            }

            $validator = Validator::make($request->all(),[
            'name' => 'required',
            'grade_id' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }


            Subject::create([
                'name' => $request->name,
                'grade_id' => $request->grade_id,
                'description' =>  $defaultDescription,
            ]);

            return redirect('/admin/subject');
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambahs data : $msg"]);
        }
    }

    public function destroy($subjectId){
        try {
            $exisData = [];
            if (DB::table('schedules')->where('subject_id', $subjectId)->exists()) {
                array_push($existData,'tagihan');
            }
             if (count($exisData) != 0){
                return back()->withErrors(['Siswa' =>"siswa yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }
            DB::table('subjects')->delete($subjectId);
            return redirect('/admin/subject');
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambahs data : $msg"]);
        }
    }

    public function update(Request $request, $subjectId){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'grade_id' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            DB::table('subjects')->where('id', $subjectId)->update([
                'name' => $request->name,
                'grade_id' => $request->grade_id,
                'description' => $request->description
            ]);
            return redirect('/admin/subject');
        }catch (Exception $e){
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat mengedit data : $msg"]);
        }
    }

    public function downloadTemplate(){
        try {
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=subject_template.csv"
            ];

            $columns = ['name', 'grade', 'description'];

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
                'grade' => $row[1],
                'description' => $row[2],
            ];
        }
        fclose($file);


        // filter for duplicate nik and gender validation

        $dataSubject = [];

        foreach ($data as $subject) {
            $validator = Validator::make($subject,[
                'name' => 'required',
                'grade' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }


            $grade = Grade::where('name', $subject['grade'])->first();
            if (!$grade) {
                return back()->withErrors(['grade' => "Kelas {$subject['grade']} tidak ditemukan."]);
            }

            if (Subject::where('name', $subject['name'])->where('grade_id',$grade->id)->exists()) {
                return back()->withErrors(['name' => "Mata Pelajaran {$subject['name']} untuk kelas {$subject['grade']} sudah terdaftar."]);
            }

            $description = $subject['description'];
            if ($description == null){
                $description = $subject['name'];
            }

            $dataSubject[] = [
                'name' => $subject['name'],
                'grade_id' => $grade->id,
                'description' => $description,
            ];

        }




        DB::transaction(function () use ($dataSubject) {
            foreach ($dataSubject as $subject) {
                Subject::create($subject);
            }
        });

        return back()->with('success', 'Data siswa berhasil diimport!');
    }

}
