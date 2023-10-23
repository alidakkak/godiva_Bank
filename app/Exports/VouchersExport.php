<?php
namespace App\Exports;

use App\Models\Voucher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VouchersExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Voucher::with("customer")->get();
    }
    public function map($voucher): array
    {

        return [
            "#".$voucher->id,
            $voucher->customer->name,
            $voucher->customer->phone,
            $voucher->customer_id,
            $voucher->created_at,
            $voucher->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'voucher_id',
            'customer_name',
            'customer_phone',
            'customer_id',
            'voucher_crated_at',
            'voucher_updated_at',
        ];
    }
}
