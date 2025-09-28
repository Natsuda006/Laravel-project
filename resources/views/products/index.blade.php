@extends('layouts.app')


@section('content')
<div class="w-full bg-gray-100 py-10"> 
    <div class="max-w-7xl mx-auto px-4">
        <div> 
            <div class="flex items-center">
                <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-12 md:h-16 mr-3">
                
            </div>
            <p class="text-lg md:text-xl font-medium text-gray-600 mt-2">ของสะสมน่ารัก ๆ สำหรับทุกคน</p>
        </div>
    </div>
</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
        @forelse ($products as $product)
         <div class="bg-white rounded-xl shadow group border border-gray-200 hover:shadow-lg hover:border-green-300 transition-all duration-300 flex flex-col h-full min-w-0">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative w-full h-[250px] bg-gray-50 flex items-center justify-center overflow-hidden rounded-t-xl">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     alt="{{ $product->name }}"
                     class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
            @else
                <span class="text-gray-300 text-5xl">🛍️</span>
            @endif
        </div>
    </a>

    <div class="p-4 flex flex-col flex-1">
        <div class="flex-1">
            <h2 class="font-bold text-base text-gray-800 mb-1 line-clamp-1">
                <a href="{{ route('products.show', $product) }}" class="hover:text-green-600 transition">
                    {{ $product->name }}
                </a>
            </h2>
            
            <p class="text-gray-600 text-xs mb-2 line-clamp-2 h-8">
                {{ $product->description }}
            </p>
        </div>

        <div class="flex items-center justify-between mt-3">
            <span class="inline-block bg-green-50 rounded-full px-3 py-0.5 text-xs font-semibold text-green-700 border border-green-200">
                {{ number_format($product->price, 2) }} บาท
            </span>
            <div class="flex gap-2">
                <a href="{{ route('products.edit', $product) }}"
                   class="inline-flex items-center px-2 py-1 text-xs bg-yellow-400 hover:bg-yellow-500 text-gray-900 border border-yellow-500 rounded-lg transition shadow-sm font-semibold">
                    ✏️ แก้ไข
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" 
                      onsubmit="return confirm('ยืนยันการลบสินค้า?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-2 py-1 text-xs bg-red-600 hover:bg-red-700 text-white border border-red-700 rounded-lg transition shadow-sm font-semibold">
                        ❌ ลบ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

        @empty
            <div class="col-span-full text-center py-20 text-gray-400 text-lg">
                😔 ไม่มีสินค้าในระบบ
            </div>
        @endforelse
    </div>
</div>
@endsection