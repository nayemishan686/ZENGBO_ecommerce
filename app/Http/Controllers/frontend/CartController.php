<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CartController extends Controller
{

    // Add to cart quickview
    public function addToCartQV(Request $request){
        $product = Product::find($request->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 1,
            'option' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->thumbnail,
            ]
        ]);
        return response()->json('Product added successfully');
    }

    // All cart details
    public function allCart(){
        $data = [];
        $data['qty'] = Cart::count();
        $data['total'] = Cart::total();
        return response()->json($data);
    }

    public function destroy()
    {
        Cart::destroy();
    }

}
