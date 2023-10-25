<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CustomerResourse extends JsonResource
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
              "name"=>$this->name,
              "number"=>$this->phone,
              "net_total"=>$this->net_total(),
              "created_at"=>$this->created_at->format('Y-m-d H:i:s'),
              "updated_at"=>$this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
}
