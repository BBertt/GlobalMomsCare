<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //

    public function index(){
        $orders = OrderDetail::all();
        return view('product.order', compact('orders'));
    }
}
