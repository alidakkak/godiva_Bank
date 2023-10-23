<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VouchersExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VoucherResourse;
use App\Models\Image;
use App\Models\Voucher;
use App\Traits\GeneralTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class VoucherController extends Controller
{
    use GeneralTrait;
    public function index()
    {
     $vouchers=Voucher::with(["customer","images"])->get();
        $vouchers_count=count($vouchers);
        $vouchers= VoucherResourse::collection($vouchers);
        $keys = ['vouchers_count','vouchers'];
        $values = [$vouchers_count,$vouchers];
        return $this->returnData(200, $keys, $values);
    }

    public function exportToExcel()
    {
            try {
                $fileName = 'voucher.xlsx';
                $sourcePath = 'exports/' . $fileName; // Path to the generated Excel file
                if(Storage::disk("uploads")->exists("exports/voucher.xlsx")){
                    Storage::disk("uploads")->delete("exports/voucher.xlsx");
                }
                Excel::store(new VouchersExport, $sourcePath, 'uploads');
                $keys = ['path_file_excel'];
                $values = [asset("uploads/exports/voucher.xlsx")];
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
            if(Storage::disk("uploads")->exists("exports/voucher.pdf")){
                Storage::disk("uploads")->delete("exports/voucher.pdf");
            }

              $pdf->save(public_path("uploads/exports/voucher.pdf"));
            $keys = ['path_file_pdf'];
            $values = [asset("uploads/exports/voucher.pdf")];

            return $this->returnData(200, $keys, $values);
        }
        catch (\Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }
    }
}
