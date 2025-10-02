<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add a product to the cart
     */
    public function addToCart(Request $request, $id)
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
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

    /**
     * Display the cart contents
     */
    public function cart()
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        return view('cart.index');
    }

    /**
     * Display the checkout page
     */
    public function checkout()
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        // Check if cart is empty
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.index')->with('error', 'ตะกร้าของคุณว่างเปล่า');
        }

        return view('cart.checkout');
    }

    /**
     * Process the checkout
     */
    public function processCheckout(Request $request)
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        // Check if cart is empty
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.index')->with('error', 'ตะกร้าของคุณว่างเปล่า');
        }

        // In a real application, you would process payment here
        // For now, we'll just clear the cart and show a success message
        
        // Clear the cart
        session()->forget('cart');
        
        return redirect()->route('products.index')->with('success', 'สั่งซื้อสินค้าเรียบร้อยแล้ว! ขอบคุณสำหรับการสั่งซื้อ');
    }

    /**
     * Update the cart item quantity
     */
    public function updateCart(Request $request)
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'อัปเดตจำนวนสินค้าแล้ว');
        }
        
        return redirect()->back();
    }

    /**
     * Remove an item from the cart
     */
    public function remove(Request $request)
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        if($request->id) {
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'ลบสินค้าจากตะกร้าแล้ว');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        // Check if user is admin
        if (Auth::user() && Auth::user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้');
        }
        
        session()->forget('cart');
        return redirect()->back()->with('success', 'ล้างตะกร้าแล้ว');
    }
}