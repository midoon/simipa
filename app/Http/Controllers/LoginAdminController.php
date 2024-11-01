<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginAdminController extends Controller
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
}
