<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use Illuminate\Database\QueryException;
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

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);


        try{
            Grade::create([
                'name' => $request->name
            ]);
            return redirect('/admin/grade');
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['kelas' => "kelas: $request->name sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }

    }
}
