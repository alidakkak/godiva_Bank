<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ExpenseResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
              "id"=>$this->id,
              "number_voucher"=>$this->voucher->number_voucher,
              "customer_id"=>$this->customer_id,
              "amount"=>$this->amount,
              "city"=>$this->city,
              "cashier_id"=>$this->user_id,
              "cashier_name"=>$this->user->name,
              "image"=>asset($this->image),
              "created_at"=>$this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}
