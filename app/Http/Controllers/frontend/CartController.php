<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {

    // Add to cart quickview
    public function addToCartQV(Request $request) {
        $product = Product::find($request->id);
        Cart::add([
            'id'     => $product->id,
            'name'   => $product->name,
            'qty'    => $request->qty,
            'price'  => $request->price,
            'weight' => 1,
            'options' => [
                'size'      => $request->size,
                'color'     => $request->color,
                'thumbnail' => $product->thumbnail,
            ],
        ]);
        return response()->json('Product added successfully');
    }

    // All cart details
    public function allCart() {
        $data          = [];
        $data['qty']   = Cart::count();
        $data['total'] = Cart::total();
        return response()->json($data);
    }

    public function destroy() {
        Cart::destroy();
    }

    public function myCart() {
        $data = Cart::content();
        // echo "<pre>";
        // print_r($data);
        return view('frontend.cart.cart',compact('data'));
        // return response()->json($data);
    }

}
