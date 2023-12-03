<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vouchers() {
        return $this->hasMany(Voucher::class,"customer_id");
    }

    public function expenses()
    {
        return $this->hasManyThrough( Expense::class,Voucher::class);
    }
    public function net_total(){
       return (float) $this->vouchers()->count() * Controller::voucher_value- $this->expenses->sum("amount");

}
public function net_total_by_id_voucher($number_voucher){
    $voucher= Voucher::where("number_voucher",$number_voucher)->first();

    return (float)  Controller::voucher_value- $voucher->expenses->sum("amount");
}
}
