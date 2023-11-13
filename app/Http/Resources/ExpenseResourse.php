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
              "customer_id"=>$this->customer_id,
              "amount"=>$this->amount,
            "image"=>asset($this->image),
              "created_at"=>$this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}
