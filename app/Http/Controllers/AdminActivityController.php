<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminActivityController extends Controller
{
    public function index(){
        $activities = Activity::all();
        return view('admin.activity.index', ['activities' => $activities]);
    }

    public function store(Request $request){
        try {
            $defaultDesc = $request->name;
            if ($request->description != null){
                $defaultDesc = $request->description;
            }
            $validator = Validator::make($request->all(),[
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            Activity::create([
                'name' => $request->name,
                'description' => $defaultDesc
            ]);

            return redirect('/admin/activity');
        } catch( Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }

    public function update(Request $request, $activityId){
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            DB::table('activities')->where('id', $activityId)->update([
                 'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect('/admin/activity');
        } catch(Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }

    public function destroy($activityId) {
        try {
            $existData = [];
            if (DB::table('attendances')->where('activity_id', $activityId)->exists()) {

                array_push($existData,'presensi');
            }

            if (count($existData) != 0){
                return back()->withErrors(['error' =>"data yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }
            DB::table('activities')->delete($activityId);
            return redirect('/admin/activity');
        } catch (Exception $e) {
             return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }
}
