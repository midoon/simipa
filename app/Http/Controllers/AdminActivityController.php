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
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            Activity::create([
                'name' => $request->name,
                'description' => $request->description
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
            DB::table('activities')->delete($activityId);
            return redirect('/admin/activity');
        } catch (Exception $e) {
             return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }
}
