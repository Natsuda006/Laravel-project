<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        // Require authentication for all actions
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function edit(Product $product)
    {
        // Check if user is admin
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Check if user is admin
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'แก้ไขสินค้าเรียบร้อยแล้ว');
    }

    public function destroy(Product $product)
    {
        // Check if user is admin
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'ลบสินค้าเรียบร้อยแล้ว');
    }
    
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    
    public function index()
    { 
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Check if user is admin
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Check if user is admin
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว');
    }
}