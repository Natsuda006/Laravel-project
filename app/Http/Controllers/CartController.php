<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'เพิ่มสินค้าลงตะกร้าแล้ว!');
}

}
