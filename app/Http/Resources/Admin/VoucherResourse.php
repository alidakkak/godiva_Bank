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
            'voucher_created_at' =>$this->created_at,
            'voucher_updated_at' =>$this->updated_at,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'customer_phone'=>$this->customer->phone,
            'voucher_path_images'=> ImageResourse::collection($this->images),
            // Add more fields as needed
        ];
    }
}
