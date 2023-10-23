<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use GeneralTrait;
    const divisor=1000;
    public function index(){
       $customers= Customer::paginate();
       $keys=["customers"];
       $values=[$customers];
       return  $this->returnData(200,$keys,$values);
    }
    public function get_five_last_customers_with_percentage()
    {
        $percentage_customers=Customer::count()/CustomerController::divisor;
        $last_five_customers=Customer::orderBy('id','desc')->limit(5)->get();
        $keys=["percentage","divisor","last_five_customers"];
        $values=[$percentage_customers,CustomerController::divisor,$last_five_customers];
        return  $this->returnData(200,$keys,$values);
    }

}

