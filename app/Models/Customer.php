<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function voucher() {
        return $this->hasOne(Voucher::class);
    }
    public function images()
    {
        return $this->hasManyThrough(VoucherItem::class, Voucher::class);
    }
    public function expenses()
    {
        return $this->hasMany( Expense::class);
    }
    public function net_total(){
       return (float) $this->images()->count() * Controller::voucher_value- $this->expenses->sum("amount");

    }
}
