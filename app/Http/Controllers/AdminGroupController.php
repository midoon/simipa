<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;

class AdminGroupController extends Controller
{
    //

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
        ]);


        try{
           Group::create([
                'grade_id' => $request->grade_id,
                'name' => $request->name
            ]);
            return redirect('/admin/grade');
        } catch (QueryException $e){
            if ($e->errorInfo[1] == 1062)//kode mysql untuk duplicate data
            {
                 return back()->withErrors(['rombel' => "rombel: $request->name sudah terdaftar."])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.'])->withInput();
        }
    }

    public function destroy($groupId){
        try {

        }catch(Exception $e){

        }
    }
}
