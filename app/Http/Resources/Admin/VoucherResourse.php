<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {

        return [
            'voucher_id' => '#'.$this->id,
            'voucher_created_at' =>$this->created_at->format('Y-m-d H:i:s'),
            'voucher_updated_at' =>$this->updated_at->format('Y-m-d H:i:s'),
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'customer_phone'=>$this->customer->phone,
            'voucher_Items'=> ImageResourse::collection($this->images),
            // Add more fields as needed
        ];
    }
}
