<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\PaymentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherPaymentController extends Controller
{
    public function filterCreate(){
        try{
            $paymentTypes = PaymentType::all();
            $groups = Group::all();
            return view('staff.teacher.payment.filter_create', ['paymentTypes' => $paymentTypes, 'groups' => $groups]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function showCreate(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'group_id' => 'required',
                'payment_type_id' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $group = Group::find($request->group_id);
            $students = $group->students;
            $paymentType = PaymentType::find($request->payment_type_id);
            return view('staff.teacher.payment.create', ['students' => $students, 'group' => $group, 'paymentType' => $paymentType, 'date' => $request->date]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }
}
