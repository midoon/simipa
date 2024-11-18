<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

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
            $exisData = [];
            if (DB::table('schedules')->where('group_id', $groupId)->exists()) {
                array_push($existData,'jadwal');
            }
            // nanti kita ubah mekanisme presensinya serta DB nya
            if (DB::table('presences')->where('group_id', $groupId)->exists()) {
                array_push($existData,'presensi');
            }

            if (DB::table('students')->where('group_id', $groupId)->exists()) {
                array_push($existData,'murid');
            }

            if (count($exisData) != 0){
                return back()->withErrors(['rombel' =>"Rombel yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }

            DB::table('groups')->delete($groupId);
            return redirect('/admin/grade');
        }catch(Exception $e){
             return back()->withErrors(['error' => "Terjadi kesalahan saat menghapus data "]);
        }
    }
}
