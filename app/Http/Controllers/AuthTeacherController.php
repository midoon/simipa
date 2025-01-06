<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthTeacherController extends Controller
{
    public function showLogin(){
        return view('auth.login_teacher');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){

        try {
            $validator = Validator::make($request->all(),[
                'nik' => 'required|numeric',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $isTeacherEsixt = DB::table('teachers')->where('nik', $request->nik)->exists();
            if (!$isTeacherEsixt) {
               return back()->withErrors(['error' => "Anda belum tercatat sebagai guru di sistem, hubungi admin untuk mendaftarkan diri anda"]);
            }

            $teacher = DB::table('teachers')->where('nik', $request->nik)->get('id');

            if (DB::table('teacher_accounts')->where('teacher_id', $teacher[0]->id)->exists()){
                return back()->withErrors(['error' => "NIK sudah terdaftar"]);
            }

            TeacherAccount::create([
                'teacher_id' => $teacher[0]->id,
                'password' => Hash::make($request->password)
            ]);

            return redirect('/teacher/login')->with('success', 'Registrasi berhasil, silahkan login');
        } catch (Exception $e) {
            return back()->withErrors(['error' => "Terjadi kesalahan saat registrasi: {$e->getMessage()}"]);
        }
    }

    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'nik' => 'required|numeric',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $isTeacherEsixt = DB::table('teachers')->where('nik', $request->nik)->exists();
            if (!$isTeacherEsixt) {
               return back()->withErrors(['error' => "NIK atau password salah"]);
            }

            $teacher = DB::table('teachers')->where('nik', $request->nik)->get();
            $isAccountExist = DB::table('teacher_accounts')->where('teacher_id', $teacher[0]->id)->exists();
            if (!$isAccountExist){
                 return back()->withErrors(['error' => "NIK atau Password salah"]);
            }

            $account = DB::table('teacher_accounts')->where('teacher_id', $teacher[0]->id)->get();
            if (!Hash::check($request->password, $account[0]->password)){
                 return back()->withErrors(['error' => "NIK atau Password salah"]);
            }

            $userDataSession = [
                'name' => $teacher[0]->name,
                'teacherId' => $teacher[0]->id,
                'role' => json_decode($teacher[0]->role)
            ];

            session(['teacher' => $userDataSession]);
            return redirect('/teacher/dashboard');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat login: {$e->getMessage()}"]);
        }
    }

    public function logout(Request $request){
        // Hapus session
        $request->session()->forget('teacher');
        $request->session()->flush();

        // Redirect ke halaman login
        return redirect('/teacher/login')->with('success', 'Anda berhasil logout');
    }
}
