<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminStudentController extends Controller
{

    public function index(Request $request){
        try {
            $query = $request->query();
            $students = Student::all();
            $groups = Group::all();
            $grades = Grade::all();

            if(isset($query['group_id'])){
               $students = Student::with('group')->where('group_id', $query['group_id'])->get();
            }
            if (isset($query['grade_id'])){
                $gradeId = $query['grade_id'];
                $students = Student::with('group.grade')->whereHas('group.grade', function ($query) use ($gradeId) {
                    $query->where('id',$gradeId);
                })->get();
            }
            if (isset($query['name'])) {
                 $students = Student::with('group')->where('name', 'like', '%' . $query['name'] . '%')->get();
            }


            //dd($students);
            return view('admin.student.index', ['students' => $students, 'groups' => $groups, 'grades' => $grades]);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data : $msg"]);
        }

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

    public function destroy($studentId){
        try {
            $exisData = [];
            if (DB::table('fees')->where('student_id', $studentId)->exists()) {
                array_push($existData,'tagihan');
            }
            // nanti kita ubah mekanisme presensinya serta DB nya
            if (DB::table('presences')->where('student_id', $studentId)->exists()) {
                array_push($existData,'presensi');
            }

            if (DB::table('payments')->where('student_id', $studentId)->exists()) {
                array_push($existData,'pembayaran');
            }

            if (count($exisData) != 0){
                return back()->withErrors(['Siswa' =>"siswa yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }

            DB::table('students')->delete($studentId);
            return redirect('/admin/student');
        } catch (Exception $e) {
             $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat menghapus data : $msg"]);
        }
    }

    public function update(Request $request, $studentId) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'nisn' => 'required',
            'gender' => 'required',
            'group_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        try {
            DB::table('students')->where('id', $studentId)->update([
                'name' => $request->name,
                'group_id' => $request->group_id,
                'nisn' => $request->nisn,
                'gender' => $request->gender,
            ]);
             return redirect("/admin/student");
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['student' => "NISN: $request->nisn sudah terdaftar."]);
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.']);
        }
    }
}
