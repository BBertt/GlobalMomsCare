<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
        use HasFactory;

    protected $fillable = ['quantity', 'status', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_order_details');
    }
}
