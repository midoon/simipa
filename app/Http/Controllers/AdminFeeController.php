<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\GradeFee;
use App\Models\Payment;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminFeeController extends Controller
{
    public function store(Request $request){
        try {

            $validator = Validator::make($request->all(),[
                'payment_type_id' => 'required',
                'grade_id' => 'required',
                'amount' => 'required',
                'due_date' => 'required',
            ]);

             if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $isFeeExsit = GradeFee::where('payment_type_id', $request->payment_type_id)->where('grade_id', $request->grade_id)->count();

            if($isFeeExsit != 0){
                return back()->withErrors(['error' => "Tagihan untuk kelas ini sudah ada"]);
            }

            DB::transaction(function() use($request){
                GradeFee::create([
                    'payment_type_id' => $request->payment_type_id,
                    'grade_id' => $request->grade_id,
                    'amount' => $request->amount,
                    'due_date' => $request->due_date,
                ]);

                $students = Student::whereHas('group.grade', function ($q) use ($request) {
                    $q->where('id', $request->grade_id);
                })->get();
                foreach($students as $s){
                    Fee::create([
                        'payment_type_id' => $request->payment_type_id,
                        'student_id' => $s->id,
                        'amount' => $request->amount,
                        'due_date' => $request->due_date,
                        'status' => 'unpaid',
                        'paid_amount' => 0,
                    ]);
                }
            });
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menyimpan data: {$e->getMessage()}"]);
        }
    }

    public function destroy($gradeFeeId){
        try {
           $gradeFee = GradeFee::find($gradeFeeId);
           $students = Student::whereHas('group.grade', function ($q) use ($gradeFee) {
                $q->where('id', $gradeFee->grade_id);
            })->get();
            // cek total amount is equal to total paid amount



            DB::transaction(function() use($gradeFee, $students){
                foreach($students as $s){
                    $fee = Fee::where('student_id', $s->id)->where('payment_type_id', $gradeFee->payment_type_id)->first();
                    $fee->delete();
                    $gradeFee->delete();
                }
            });
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menghapus data: {$e->getMessage()}"]);
        }
    }

    public function update(Request $request, $gradeFeeId){
        try {
            $validator = Validator::make($request->all(),[
                'payment_type_id' => 'required',
                'amount' => 'required',
                'due_date' => 'required',
            ]);

             if ($validator->fails()) {
                return back()->withErrors($validator);
            }


            DB::transaction(function() use ($request, $gradeFeeId){
                $gradeFee = GradeFee::find($gradeFeeId);
                $gradeFee->update([
                    'payment_type_id' => $request->payment_type_id,
                    'amount' => $request->amount,
                    'due_date' => $request->due_date,
                ]);

                $students = Student::whereHas('group.grade', function ($q) use ($request) {
                    $q->where('id', $request->grade_id);
                })->get();




                foreach($students as $s){
                    $fee = Fee::where('student_id', $s->id)->where('payment_type_id', $request->payment_type_id)->first();

                    $status = $fee->status;
                    $isPaid = true;
                    if ($request->amount > $fee->paid_amount){
                        $isPaid = false;
                    }
                    if ($isPaid){
                        $status = 'paid';
                    }
                    $fee->update([
                        'payment_type_id' => $request->payment_type_id,
                        'amount' => $request->amount,
                        'due_date' => $request->due_date,
                        'status' => $status,
                    ]);
                }
            });


            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat mengupdate data: {$e->getMessage()}"]);
        }
    }
}
