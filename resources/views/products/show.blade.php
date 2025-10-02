@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">รายละเอียดสินค้า</h1>
        <div class="flex flex-col items-center">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="rounded-xl shadow mb-6 object-contain" style="max-width: 100%; max-height: 420px;">
            @endif
            <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">{{ $product->name }}</h2>
            <p class="text-gray-600 text-base mb-4 text-center">{{ $product->description }}</p>
            <div class="text-green-700 text-xl font-semibold mb-6">{{ number_format($product->price, 2) }} บาท</div>
            
            <div class="flex gap-4 mb-6">
                @auth
                    @if(!Auth::user()->isAdmin())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                                🛒 เพิ่มลงตะกร้า
                            </button>
                        </form>
                    @endif
                @endauth
                
                @guest
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                            🛒 เพิ่มลงตะกร้า
                        </button>
                    </form>
                @endguest
                
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('products.edit', $product) }}" 
                           class="px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg shadow transition">
                            ✏️ แก้ไขสินค้า
                        </a>
                    @endif
                @endauth
                
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow transition">ย้อนกลับ</a>
            </div>
        </div>
    </div>
</div>
@endsection