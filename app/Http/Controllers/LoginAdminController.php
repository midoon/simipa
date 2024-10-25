<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAdminController extends Controller
{

    public function index(){
        return view('auth.login_admin');
    }

    public function auth(Request $request){
        $envUsername = env('ADMIN_USERNAME');
        $envPassword = env('ADMIN_PASSWORD');

        if( $request->username != $envUsername){
            return redirect()->back()->with('error', 'username atau password salah');
        }
        if( $request->password != $envPassword){
            return redirect()->back()->with('error', 'username atau password salah');
        }

        return view('admin.dashboard');

    }
}
