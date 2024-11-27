<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
        use HasFactory;

    protected $fillable = ['quantity', 'status', 'product_id', 'accountorderdetail_id'];

    public function accountOrderDetail()
    {
        return $this->belongsTo(AccountOrderDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
