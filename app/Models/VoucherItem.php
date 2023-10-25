<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherItem extends Model
{
    use HasFactory;
    protected $table="vouchers_items";
    protected $fillable=["path","voucher_id","city"];
}
