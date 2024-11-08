<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use Illuminate\Http\Request;

class AdminGradeController extends Controller
{
    public function index(){
        $groups = Group::all();
        $grades = Grade::all();
        return view('admin.grade.index',[
            'groups' => $groups,
            'grades' => $grades
        ]);
    }
}
