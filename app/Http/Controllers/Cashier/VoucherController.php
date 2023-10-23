<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExistingVoucherRequest;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Resources\Admin\VoucherResourse;
use App\Models\Customer;
use App\Models\Voucher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    use GeneralTrait;


    public function store(StoreVoucherRequest $request){
       $old= Customer::where("name",$request->name)->where("phone",$request->number)->first();
       if ($old) {
           $old->images()->create([
               "path" => $request->image,
               "voucher_id" => $old->voucher->id,
           ]);
           $keys=["voucher"];
           $values=[VoucherResourse::make($old->voucher)];
           return  $this->returnData(201,$keys,$values);
       }
        DB::beginTransaction();
        try {
      $customer= Customer::create([
           "name" => $request->name,
           "phone"=>$request->number,
       ]);
   $voucher=   $customer->voucher()->create();
      $customer->images()->create([
                "path" =>  $request->image,
                "voucher_id" => $voucher->id,
            ]);

       DB::commit();
            $keys=["voucher"];
            $values=[VoucherResourse::make($voucher)];
            return  $this->returnData(201,$keys,$values);
        }
       catch (\Exception $e){
           DB::rollBack();
           return $e->getMessage();
        }
    }
    public function existing(ExistingVoucherRequest $request){
        try {
            $old = Customer::where("name", $request->name)->first();
            if ($old) {
                $old->images()->create([
                    "path" => $request->image,
                    "voucher_id" => $old->voucher->id,
                ]);
                $keys = ["voucher"];
                $values = [VoucherResourse::make($old->voucher)];
                return $this->returnData(201, $keys, $values);
            }

            return $this->returnError(404,"the voucher not existing");

        }
    catch (\Exception $e){
            return $e->getMessage();
        }
    }

}
