<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function index(){
        return view('auth.login_admin');
    }

    public function auth(Request $request){
        $envUsername = env('ADMIN_USERNAME');
        $envPassword = env('ADMIN_PASSWORD');

        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $dataSession = [
             'username' => $request->input('username'),
             'role' => "admin"
        ];



        if( $data["username"] != $envUsername){
            return redirect()->back()->with('error', 'username atau password salah');
        }
        if( $data["password"] != $envPassword){
            return redirect()->back()->with('error', 'username atau password salah');
        }

        session(['user' => $dataSession]);

        return redirect("/admin/dashboard");

    }

    public function logout(Request $request){
        // Hapus session
        $request->session()->forget('user');
        $request->session()->flush();

        // Redirect ke halaman login
        return redirect('/admin/login')->with('success', 'Anda berhasil logout');
    }
}
