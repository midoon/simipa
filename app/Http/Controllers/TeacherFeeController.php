<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherFeeController extends Controller
{
    public function filterRead(){
        try {
            $groups = Group::all();
            return view('staff.teacher.fee.filter_read', compact('groups'));
        } catch (Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function showRead(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',

            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $group = Group::find($request->group_id);
            $groupName = $group->name;
            if(!$group){
                return back()->with('error', 'Group tidak ditemukan');
            }

            $students = $group->students;
            $studentFee = [];

            foreach ($students as $student){

                $tempFee = [];

                foreach ($student->fees as $fee){
                    array_push($tempFee, [
                        'fee' => $fee->paymentType->name,
                        'amount' => $fee->amount,
                        'remainingAmount' => $fee->paid_amount - $fee->amount,
                        'dueDate' => $fee->due_date,
                    ]);
                }

                array_push($studentFee,  [
                    'name' => $student->name,
                    'studentId' => $student->id,
                    'fees' => $tempFee,
                ]);
                $tempFee = [];

            }

            return view('staff.teacher.fee.read', compact('studentFee', 'groupName'));


        } catch (Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
