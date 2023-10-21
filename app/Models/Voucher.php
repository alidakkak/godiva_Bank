<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function setImageAttribute ($image){
        $newImageName = uniqid() . '_' . 'voucher_image' . '.' . $image->extension();
        $image->move(public_path('voucher_image') , $newImageName);
        return $this->attributes['image'] =  '/'.'voucher_image'.'/' . $newImageName;
    }
}
