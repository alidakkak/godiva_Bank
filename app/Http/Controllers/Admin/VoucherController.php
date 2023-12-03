<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VouchersExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VoucherResourse;
use App\Models\VoucherItem;
use App\Models\Voucher;
use App\Traits\GeneralTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class VoucherController extends Controller
{
    use GeneralTrait;
    const divisor=1000;
    public function index()
    {
     $vouchers=Voucher::with(["customer","expenses"])->get();
        $vouchers= VoucherResourse::collection($vouchers);
        $keys = ['vouchers'];
        $values = [$vouchers];
        return $this->returnData(200, $keys, $values);
    }


    public function percentage(){
        $percentage_all_vouchers=Voucher::count();
        $percentage_all_vouchers_in_jedda=0;
        $percentage_all_vouchers_in_dammam=0;
        $percentage_all_vouchers_in_riyadh=0;
        if (Voucher::count()!=0){
            $percentage_all_vouchers_in_jedda=round(Voucher::where("city","jedda")->count("city") *100/Voucher::count("city"),0);
            $percentage_all_vouchers_in_dammam=round(Voucher::where("city","dammam")->count("city") *100/Voucher::count("city"),0);
            $percentage_all_vouchers_in_riyadh=round(Voucher::where("city","riyadh")->count("city") *100/Voucher::count("city"),0);
        }
        $keys=["percentage_total_voucher"
            ,"divisor_of_total_voucher"
            ,"percentage_total_voucher_Jedda"
            ,"percentage_total_voucher_Dammam"
            ,"percentage_total_voucher_Riyadh"
        ];
        $values=[$percentage_all_vouchers
            ,CustomerController::divisor
            ,$percentage_all_vouchers_in_jedda
            ,$percentage_all_vouchers_in_dammam
            ,$percentage_all_vouchers_in_riyadh];
        return  $this->returnData(200,$keys,$values);
    }
        public function download($folder,$name){
      return  Storage::download("public/".$folder."/".$name);
        }
}
