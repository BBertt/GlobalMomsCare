<?php

namespace App\Http\Controllers;

use App\Models\AccountOrderDetail;
use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function store(Request $request){
        $accountOrderDetail = AccountOrderDetail::create([
            'status' => 'Waiting Payment',
            'deliver' => now()->addDays(0),
            'arrive' => now()->addDays(2),
            'account_id' => Auth::id(),
        ]);

        foreach($request->carts as $cart){
            OrderDetail::create([
                'quantity' => $cart['quantity'],
                'product_id' => $cart['product_id'],
                'accountorderdetail_id' => $accountOrderDetail->id,
            ]);
        }

        Cart::where('account_id', Auth::id())->delete();

        return redirect()->route('products.index');
    }
}
