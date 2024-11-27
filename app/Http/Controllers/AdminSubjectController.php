<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminSubjectController extends Controller
{
    public function index(Request $request){
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('admin.subject.index', ['grades' => $grades, 'subjects' => $subjects]);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(),[
            'name' => 'required',
            'grade_id' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        Subject::create([
            'name' => $request->name,
            'grade_id' => $request->grade_id,
            'description' => $request->description
        ]);

        return redirect('/admin/subject');
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambahs data : $msg"]);
        }
    }
}
