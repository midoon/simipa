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
}
