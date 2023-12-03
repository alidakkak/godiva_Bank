<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResourse;
use App\Models\Customer;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $cusromer = Customer::with("expenses","vouchers")->get();
        return CustomerResourse::collection($cusromer);
    }

    public function show(Customer $customer) {
        return $customer->with('voucher')->find($customer->id);
    }

    public function store(Request $request) {
        $vouchers = $request->file('vouchers');
       $customer = Customer::create($request->all());
       if ($vouchers){
           foreach($vouchers as $voucher) {
               Voucher::create([
                   'customer_id' => $customer->id,
                   'image' => $voucher,
               ]);
           }
       }
       return $customer;
    }

    public function update(Request $request, Customer $customer) {
        $vouchers = $request->file('vouchers');
//        $old = Customer::find($customer->id);
//        if (!$old) {
//            return 'Customer Not Found';
//        }
        Voucher::create([
            'customer_id' => $customer->id,
            'image' => $vouchers,
        ]);
        return $customer;
    }



//    public function store(Request $request) {
//        $vouchers = $request->file('vouchers');
//        $customer = Customer::create($request->all());
//        // الحصول على الفاتورة القديمة لنفس الزبون
//        $oldInvoice = $customer->voucher;
//        // إنشاء فاتورة جديدة
//        $newInvoice = Voucher::create([
//            'customer_id' => $customer->id,
//            'image' => $vouchers,
//        ]);
//        // إضافة الفاتورة الجديدة إلى الفاتورة القديمة
//        if ($oldInvoice) {
//            $oldInvoice->update([
//                'image' => array_merge($oldInvoice->image, $newInvoice->image),
//            ]);
//        } else {
//            $customer->update([
//                'image' => $newInvoice->image,
//            ]);
//        }
//        return $customer;
//    }

}
