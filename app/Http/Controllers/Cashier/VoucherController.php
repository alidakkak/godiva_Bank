<?php

namespace App\Http\Controllers\Cashier;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExistingVoucherRequest;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Resources\Admin\VoucherResourse;
use App\Models\Customer;
use App\Models\Voucher;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    use GeneralTrait;
//if ($request->amount>Controller::voucher_value) {
//return  $this->returnError(200,"amount must be smaller than voucher");
//}
//else if ($request->amount>=$old_customer->net_total_by_id_voucher($request->number_voucher)) {
//    return  $this->returnError(200,"the customer doesn't have amount");
//}

    public function store(StoreVoucherRequest $request){

        $ImagePath=$this->store_image($request);
        DB::beginTransaction();
        try{
        $same_phone_but_change_name= Customer::where("name","!=",$request->name)->where("phone",$request->number)->first();

        if ($same_phone_but_change_name) {
          return $this->returnError(200,"This phone already exists under the name ".$same_phone_but_change_name->name);
        }

         $old_customer= Customer::where("name",$request->name)->where("phone",$request->number)->first();

        if ($old_customer) {
            $old_voucher = $old_customer->vouchers()->where("number_voucher", $request->number_voucher)->first();
        if ($old_voucher) {
            return $this->returnError(200,"This voucher already exists under the name ".
                $old_customer->name." the phone ".$old_customer->phone);
        }
        $voucher = $old_customer->vouchers()->create(
            [
                "number_voucher" => $request->number_voucher,
                "city" => $request->city,

            ]);
            if ($request->amount>Controller::voucher_value) {
                return  $this->returnError(200,"amount must be smaller than voucher");
            }

            if ($request->amount>$old_customer->net_total_by_id_voucher($request->number_voucher)) {
                return  $this->returnError(200,"the customer doesn't have amount");
            }
        $voucher->expenses()->create([
            "amount" => $request->amount,
            "city" => $request->city,
            "image" => $ImagePath,
            "user_id" => Auth::id(),
            "customer_id" => $old_customer->id,
        ]);
            DB::commit();
        $keys=["voucher"];
        $values=[VoucherResourse::make($voucher)];
        return  $this->returnData(201,$keys,$values);
    }

else {
    $customer = Customer::create([
        "name" => $request->name,
        "phone" => $request->number,
    ]);
    $voucher = $customer->vouchers()->create(
        [
            "number_voucher" => $request->number_voucher,
            "city" => $request->city,
        ]);
    if ($request->amount>Controller::voucher_value) {
        return  $this->returnError(200,"amount must be smaller than voucher");
    }
    if ($request->amount>$customer->net_total_by_id_voucher($request->number_voucher)) {
        return  $this->returnError(200,"the customer doesn't have amount");
    }
    $voucher->expenses()->create([
        "amount" => $request->amount,
        "city" => $request->city,
        "image" => $ImagePath,
        "user_id" => Auth::id(),
        "customer_id" => $customer->id,
    ]);

    DB::commit();
    $keys = ["voucher"];
    $values = [VoucherResourse::make($voucher)];
    return $this->returnData(201, $keys, $values);
}}
        catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }
    public function existing(ExistingVoucherRequest $request){
        try {

            $ImagePath=$this->store_image($request);
            $customer= Customer::where("phone",$request->number)->first();
            if ($customer) {
                $voucher = $customer->vouchers()->where("number_voucher", $request->number_voucher)->first();
            if ($voucher ) {
            if ($request->amount>Controller::voucher_value) {
                return  $this->returnError(200,"amount must be smaller than voucher");
            }
            if ($request->amount>$customer->net_total_by_id_voucher($request->number_voucher)) {
                return  $this->returnError(200,"the customer doesn't have amount");
            }
                $voucher->expenses()->create([
                    "amount" => $request->amount,
                    "city" => $request->city,
                    "image" => $ImagePath,
                    "user_id" => Auth::id(),
                    "customer_id" => $customer->id,
                ]);
                $keys = ["voucher"];
                $values = [VoucherResourse::make($voucher)];
                return $this->returnData(201, $keys, $values);
            }

            }
            return $this->returnError(404,"phone number dont exist");

        }
    catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function store_image($request){
        $decodedImage =$request->image;
        $base64String = substr($decodedImage, strpos($decodedImage, ',') + 1);
        $decodedImage = base64_decode($base64String);
        $fileName = $request->name.time().'.jpg';
        $filePath = 'images/'.$fileName;
        Storage::disk('uploads')->put($filePath, $decodedImage);
        return "uploads/images/".$fileName;
    }
    public function check_voucher($route)
    {
        $voucher = Voucher::where("number_voucher", $route)->first();
        if (!$voucher) {
           return response([
               "message"=>"voucher dont create",
               "access"=>true
           ],200);
        }
        elseif ($voucher->customer->net_total_by_id_voucher($route)<=0) {
            return response([
                "message"=>"blank",
                "access"=>false,
                "net_total"=>$voucher->customer->net_total_by_id_voucher($route),
            ],200);
        }
        elseif ($voucher->customer->net_total_by_id_voucher($route)>0) {

            return response([
                "message"=>"allowed voucher",
                "access"=>true,
                "net_total"=>$voucher->customer->net_total_by_id_voucher($route),
            ],200);
        }


    }

}
