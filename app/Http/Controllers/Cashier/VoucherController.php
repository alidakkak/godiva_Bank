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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    use GeneralTrait;


    public function store(StoreVoucherRequest $request){
        $ImagePath=$this->store_image($request);
      $old= Customer::where("name",$request->name)->where("phone",$request->number)->first();
       if ($old) {
           $old->images()->create([
               "path" => $ImagePath,
               "voucher_id" => $old->voucher->id,
               "city"=>$request->city,
           ]);
           $old->voucher()->update(["updated_at"=>Carbon::now()]);
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
                "path" =>$ImagePath,
                "voucher_id" => $voucher->id,
                "city"=>$request->city,
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
            $ImagePath=$this->store_image($request);
            $old = Customer::where("name", $request->name)->first();
            if ($old) {
                $old->images()->create([
                    "path" => $ImagePath,
                    "voucher_id" => $old->voucher->id,
                    "city"=>$request->city,
                ]);
                $old->voucher()->update(["updated_at"=>Carbon::now()]);
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
    public function store_image($request){
        $decodedImage =$request->image;
        $base64String = substr($decodedImage, strpos($decodedImage, ',') + 1);
        $decodedImage = base64_decode($base64String);
        $fileName = $request->name.time().'.jpg';
        $filePath = 'images/'.$fileName;
        Storage::disk('public')->put($filePath, $decodedImage);
        return asset("api/download/images/".$fileName);
    }

}
