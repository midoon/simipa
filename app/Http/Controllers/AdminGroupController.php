<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminGroupController extends Controller
{
    //

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
        ]);


    }
}
