<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['productName', 'description', 'price', 'stock', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function pictures()
    {
        return $this->belongsToMany(Picture::class, 'product_pictures');
    }
}
