<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherAuthController extends Controller
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

            $teacher = Teacher::where('nik', $request->nik)->first();

            if ($teacher->account){
                 return back()->withErrors(['error' => "nik sudah digunakan oleh akun lain"]);
            }


            $teacher->update([
                'account' => true,
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

            // validasi nik
            $teacher = Teacher::where('nik', $request->nik)->first();
            if (!$teacher) {
               return back()->withErrors(['error' => "NIK atau password salah"]);
            }

            if (!Hash::check($request->password, $teacher->password)){
                 return back()->withErrors(['error' => "NIK atau Password salah"]);
            }

            if (!$teacher->account){
                 return back()->withErrors(['error' => "Belum memiliki account, silahkan registrasi"]);
            }



            $userDataSession = [
                'name' => $teacher->name,
                'teacherId' => $teacher->id,
                'role' => $teacher->role // need solve
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
