<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function index(){
        return view('admin.teacher');
    }

    public function store(Request $request){



      if ($request->roles == null){
        dd("null coy");
      } else {
         dd($request->roles);
      }



    }
}
