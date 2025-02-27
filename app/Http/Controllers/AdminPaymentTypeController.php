<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\GradeFee;
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
            $grades = Grade::all();
            $gradeFees = GradeFee::all();
            return view('admin.payment.index', ['paymentTypes' => $paymentTypes , 'grades' => $grades, 'gradeFees' => $gradeFees]);
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat memuat data: {$e->getMessage()}"]);
        }
    }

    public function store(Request $request){
        try{
            $defDesc = $request->name;
            if ($request->description != null){
                $defDesc = $request->description;
            }

            $validator = Validator::make($request->all(),[
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $isExist = PaymentType::where('name', $request->name)->exists();
            if ($isExist){
                return back()->withErrors(['error' => "Jenis pembayaran {$request->name} sudah ada"]);
            }

            PaymentType::create([
                'name' => $request->name,
                'description' =>$defDesc
            ]);
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat menyimpan data: {$e->getMessage()}"]);
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

            $paymentType = PaymentType::where('name', $request->name)->first();
            if ($paymentType != null && $paymentType->id != $paymentTypeId){
                return back()->withErrors(['error' => "Jenis pembayaran {$request->name} sudah ada"]);
            }

            DB::table('payment_types')->where("id", $paymentTypeId)->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect('/admin/payment/type');
        } catch (Exception $e){
            return back()->withErrors(['error' => "Terjadi kesalahan saat mengedit data: {$e->getMessage()}"]);
        }
    }

    public function destroy($paymentTypeId){
        try {
            $existData = [];
            if (DB::table('fees')->where('payment_type_id', $paymentTypeId)->exists()) {

                array_push($existData,'tagihan');
            }

            if (count($existData) != 0){
                return back()->withErrors(['error' =>"data yang ingin anda hapus masih digunakan di data " . implode(", ",$existData)]);
            }

            DB::table('payment_types')->delete($paymentTypeId);
             return redirect('/admin/payment/type');
        } catch (Exception $e) {
            return back()->withErrors(['error' => "Terjadi kesalahan saat menghapus data: {$e->getMessage()}"]);
        }
    }
}
