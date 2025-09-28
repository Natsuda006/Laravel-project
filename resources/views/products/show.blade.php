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
            <a href="{{ route('products.index') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition">ย้อนกลับ</a>
        </div>
    </div>
</div>
@endsection
