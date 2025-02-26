<?php

namespace App\Http\Controllers;

use App\Events\StudentAssignedToGroup;
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

    public function index(Request $request) {
        try {
            // Ambil query parameter
            $query = $request->query();

            // Mulai membangun query untuk Student
            $studentsQuery = Student::query()->with('group.grade');

            // Filter berdasarkan group_id jika ada
            $studentsQuery->when(isset($query['group_id']), function ($q) use ($query) {
                $q->where('group_id', $query['group_id']);
            });

            // Filter berdasarkan grade_id jika ada
            $studentsQuery->when(isset($query['grade_id']), function ($q) use ($query) {
                $q->whereHas('group.grade', function ($subQuery) use ($query) {
                    $subQuery->where('id', $query['grade_id']);
                });
            });

            // Filter berdasarkan nama jika ada
            $studentsQuery->when(isset($query['name']), function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query['name'] . '%');
            });

            // Eksekusi query
            $students = $studentsQuery->paginate(40);

            // Ambil data groups dan grades
            $groups = Group::all();
            $grades = Grade::all();

            // Tampilkan view
            return view('admin.student.index', [
                'students' => $students,
                'groups' => $groups,
                'grades' => $grades,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }


    public function store(Request $request) {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'group_id' => 'required',
                'nisn' => 'required',
                'gender' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }


            $student = Student::create([
            'name' => $request->name,
            'group_id' => $request->group_id,
            'nisn' => $request->nisn,
            'gender' => $request->gender,
            ]);

            // event(new StudentAssignedToGroup($student));
            StudentAssignedToGroup::dispatch($student);

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
            if (DB::table('attendances')->where('student_id', $studentId)->exists()) {
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


    public function downloadTemplate(){
        try {
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=student_template.csv"
            ];

            $columns = ['name', 'nisn', 'gender', 'group'];

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
}
