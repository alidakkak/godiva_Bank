<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetExpensesRequest;
use App\Http\Resources\CustomerResourse;
use App\Http\Resources\ExpenseResourse;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use GeneralTrait;
    const divisor=1000;
    public function index(){
       $customers= Customer::with("expenses","images")->paginate();
       $keys=["customers"
           ,"current_page"
           ,"last_page"
           ,"first_page_url"
           ,"last_page_url"
           ,"prev_page_url"
           ,"next_page_url"
           ];
       $values=[CustomerResourse::collection($customers)
                ,$customers->currentPage()
                ,$customers->lastPage()
                ,$customers->url(1)
                ,$customers->url($customers->lastPage())
                ,$customers->previousPageUrl()
                , $customers->nextPageUrl()];
       return  $this->returnData(200,$keys,$values);
    }
    public function get_five_last_customers_with_percentage()
    {
        $percentage_customers=Customer::count()/CustomerController::divisor;
        $last_five_customers=Customer::orderBy('id','desc')->limit(5)->get();
        $keys=["percentage","divisor","last_five_customers"];
        $values=[$percentage_customers,CustomerController::divisor,CustomerResourse::collection($last_five_customers)];
        return  $this->returnData(200,$keys,$values);
    }
        public function get_expenses(GetExpensesRequest $request){
          $customer=  Customer::find($request->customer_id);
            $keys=["payments"];
            $values=[ExpenseResourse::collection($customer->expenses)];
            return  $this->returnData(200,$keys,$values);
        }
}

