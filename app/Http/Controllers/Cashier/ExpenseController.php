<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Http\Resources\ExpenseResourse;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Voucher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
use GeneralTrait;

    public function store(ExpensesRequest $request)
    {
        try {
            $ImagePath=$this->store_image($request);
            $customer= Voucher::where("number_voucher",$request->number_voucher)->first()->customer;

            if ($request->amount>Controller::voucher_value) {
                return  $this->returnError(200,"amount must be smaller than voucher");
            }
            if ($request->amount>$customer->net_total()) {
                return  $this->returnError(200,"the customer doesn't have amount");
            }

             $expense=  $customer->expenses()->create([
               "amount" => $request->amount,
               "image" => $ImagePath,
               "city" => $request->city,
                "user_id"=>Auth::id(),
              ]);
            $keys = ["expense"];
            $values = [ExpenseResourse::make($expense)];
            return $this->returnData(201, $keys, $values);
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
        return "api/download/images/".$fileName;
    }

}
