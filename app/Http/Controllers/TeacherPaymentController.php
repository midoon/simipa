<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Group;
use App\Models\Payment;
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

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'payment_type_id' => 'required',
                'date' => 'required',
                'student_id' => 'required',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $fee= Fee::where('student_id', $request->student_id)
                ->where('payment_type_id', $request->payment_type_id)
                ->first();

            if ($fee->status == 'paid') {
                return back()->withErrors(['error' => "Siswa sudah membayar {$fee->paymentType->name}"]);
            }

            $statusFee = 'partial';
            $remainingAmount = $fee->paid_amount + $request->amount;
            if ($remainingAmount >= $fee->amount) {
                $statusFee = 'paid';
            }



            $fee->update([
                'status' => $statusFee,
                'paid_amount' => $fee->paid_amount + $request->amount,
            ]);

            Payment::create([
                'payment_type_id' => $request->payment_type_id,
                'payment_date' => $request->date,
                'amount' => $request->amount,
                'student_id' => $request->student_id,
                "description" => $request->description,
            ]);


             return back()->with('success', 'Pembayaran berhasil disimpan');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menyimpan data: {$e->getMessage()}"]);
        }
    }
}
