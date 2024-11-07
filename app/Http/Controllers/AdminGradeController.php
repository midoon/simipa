<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminGradeController extends Controller
{
    public function index(){
        return view('admin.grade.grade');
    }
}
