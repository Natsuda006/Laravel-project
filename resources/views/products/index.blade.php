@extends('layouts.app')

@section('content')



<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24">

  
    <div class="mb-12">
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <div class="flex flex-col items-center gap-4">
                
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-24 md:h-32 object-contain">
                </div>
                  <p class="text-xl text-gray-600 text-center max-w-md">
                    ยินดีต้อนรับ
                </p>

                <p class="text-xl text-gray-600 text-center max-w-md">
                    ของสะสมน่ารัก ๆ สำหรับทุกคน
                </p>

            </div>
        </div>
    </div>

   
    <div class="pt-28 bg-cover bg-center bg-no-repeat" style="background-image: url('https://i.pinimg.com/736x/f9/55/ca/f955cad34d006f734605fa67a9ec44ce.jpg');">

   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-lg transition-all duration-300 flex flex-col h-full">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="relative w-full h-48 md:h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="text-4xl text-gray-300">🛍️</div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </a>

                    <div class="p-4 flex flex-col flex-1">
                        <div class="flex-1">
                            <h2 class="font-semibold text-base text-gray-900 mb-2 line-clamp-1">
                                <a href="{{ route('products.show', $product) }}" class="hover:text-green-600 transition">
                                    {{ $product->name }}
                                </a>
                            </h2>
                            
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <span class="inline-block bg-green-100 rounded-full px-3 py-1 text-sm font-semibold text-green-800">
                                {{ number_format($product->price, 2) }} บาท
                            </span>
                            
                            <div class="flex gap-3">
                                @auth
                                    @if(!Auth::user()->isAdmin())
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition shadow-sm font-medium">
                                                🛒
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                                
                                @guest
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition shadow-sm font-medium">
                                            🛒
                                        </button>
                                    </form>
                                @endguest
                                
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="inline-flex items-center px-4 py-2 text-sm bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-lg transition shadow-sm font-medium">
                                            ✏️
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" 
                                              onsubmit="return confirm('ยืนยันการลบสินค้า?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition shadow-sm font-medium">
                                                ❌
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-6xl mb-4">😔</div>
                    <h3 class="text-2xl font-medium text-gray-900 mb-2">ไม่มีสินค้าในระบบ</h3>
                    <p class="text-gray-600 mb-6">ขออภัย ขณะนี้ยังไม่มีสินค้าในร้านค้า</p>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                เพิ่มสินค้าใหม่
                            </a>
                        @endif
                    @endauth
                </div>
            @endforelse
        </div>
        
        <div class="mt-8 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection