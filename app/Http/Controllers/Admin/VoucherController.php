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
     $vouchers=Voucher::with(["customer","images"])->get();
        $vouchers= VoucherResourse::collection($vouchers);
        $keys = ['vouchers'];
        $values = [$vouchers];
        return $this->returnData(200, $keys, $values);
    }

    public function exportToExcel()
    {
            try {
                $fileName = 'voucher.xlsx';
                $sourcePath = 'exports/' . $fileName; // Path to the generated Excel file
                if(Storage::disk("public")->exists("exports/voucher.xlsx")){
                    Storage::disk("public")->delete("exports/voucher.xlsx");
                }
                Excel::store(new VouchersExport, $sourcePath, 'public');
                $keys = ['path_file_excel'];
                $values = [asset("api/download/exports/voucher.xlsx")];
                return $this->returnData(200, $keys, $values);
            }
            catch (\Exception $e) {
                return "An error occurred: " . $e->getMessage();
            }
    }
    public function exportToPdf()
    {
        try {
            $vouchers = Voucher::with("customer")->get();

            // Generate the PDF document
            $pdf = PDF::loadView('pdf_template', ['vouchers' => $vouchers]);
            // Save the PDF to a file
            if(Storage::disk("public")->exists("exports/voucher.pdf")){
                Storage::disk("public")->delete("exports/voucher.pdf");
            }

            Storage::disk('public')->put("exports/voucher.pdf", $pdf->output());
            $keys = ['path_file_pdf'];
            $values = [asset("api/download/exports/voucher.pdf")];

            return $this->returnData(200, $keys, $values);
        }
        catch (\Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }
    }
    public function percentage(){
        $percentage_all_vouchers=VoucherItem::count()/CustomerController::divisor;
        $percentage_all_vouchers_in_jedda=0;
        $percentage_all_vouchers_in_dammam=0;
        $percentage_all_vouchers_in_riyadh=0;
        if (Voucher::count()!=0){
            $percentage_all_vouchers_in_jedda=round(VoucherItem::where("city","jedda")->count("city") *100/VoucherItem::count("city"),2);
            $percentage_all_vouchers_in_dammam=round(VoucherItem::where("city","dammam")->count("city") *100/VoucherItem::count("city"),2);
            $percentage_all_vouchers_in_riyadh=round(VoucherItem::where("city","riyadh")->count("city") *100/VoucherItem::count("city"),2);
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
