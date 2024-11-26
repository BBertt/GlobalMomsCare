<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('product.product', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $products = Product::create([
            'account_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($request->has('categories')) {
            $products->categories()->attach($request->categories);
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $products->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('products.index');
    }
}
