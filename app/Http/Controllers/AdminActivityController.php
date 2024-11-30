<?php

namespace App\Http\Controllers;

use App\Models\PresenceCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminActivityController extends Controller
{
    public function index(){
        $activities = PresenceCategory::all();
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

            PresenceCategory::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect('/admin/activity');
        } catch( Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menambah data: {$e->getMessage()}"]);
        }
    }
}
