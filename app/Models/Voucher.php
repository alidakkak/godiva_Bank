<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function expenses() {
        return $this->hasMany(Expense::class);
    }
}
