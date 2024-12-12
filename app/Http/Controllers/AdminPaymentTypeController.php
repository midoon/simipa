<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminPaymentTypeController extends Controller
{
    public function index(){
        try {
            $paymentTypes = PaymentType::all();
            return view('admin.payment.index', ['paymentTypes' => $paymentTypes]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function store(Request $request){
        try {
             $validator = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            PaymentType::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function update(Request $request, $paymentTypeId){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            DB::table('payment_types')->where("id", $paymentTypeId)->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }
}
