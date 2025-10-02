@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">ตะกร้าสินค้า</h1>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    @auth
        @if(Auth::user()->isAdmin())
            <div class="bg-red-50 border border-red-200 rounded-xl p-8 text-center">
                <div class="text-5xl mb-4">🚫</div>
                <h3 class="text-xl font-medium text-red-800 mb-2">ผู้ดูแลระบบไม่สามารถใช้ตะกร้าสินค้าได้</h3>
                <p class="text-red-600 mb-6">คุณเข้าสู่ระบบในฐานะผู้ดูแลระบบ ซึ่งไม่สามารถทำการสั่งซื้อสินค้าได้</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                    กลับไปที่หน้าสินค้า
                </a>
            </div>
        @elseif(session('cart') && count(session('cart')) > 0)
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สินค้า</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคา</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จำนวน</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รวม</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $item)
                                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($item['image'])
                                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden">
                                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 h-16 w-16 rounded-md bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500">🛍️</span>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($item['price'], 2) }} บาท
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="flex items-center">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 rounded border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                                <button type="submit" class="ml-2 text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg">อัปเดต</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ number_format($subtotal, 2) }} บาท
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-600 hover:text-red-900">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-semibold text-gray-900">
                            รวมทั้งหมด: {{ number_format($total, 2) }} บาท
                        </div>
                        <div class="flex space-x-4">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    ล้างตะกร้า
                                </button>
                            </form>
                            <a href="{{ route('cart.checkout') }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                ดำเนินการสั่งซื้อ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">ตะกร้าของคุณว่างเปล่า</h3>
                <p class="text-gray-500 mb-6">เพิ่มสินค้าที่คุณต้องการลงในตะกร้า</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700">
                    เลือกสินค้า
                </a>
            </div>
        @endif
    @else
        @if(session('cart') && count(session('cart')) > 0)
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สินค้า</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคา</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จำนวน</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รวม</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $item)
                                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($item['image'])
                                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden">
                                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 h-16 w-16 rounded-md bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500">🛍️</span>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($item['price'], 2) }} บาท
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="flex items-center">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 rounded border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                                <button type="submit" class="ml-2 text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg">อัปเดต</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ number_format($subtotal, 2) }} บาท
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-600 hover:text-red-900">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-semibold text-gray-900">
                            รวมทั้งหมด: {{ number_format($total, 2) }} บาท
                        </div>
                        <div class="flex space-x-4">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    ล้างตะกร้า
                                </button>
                            </form>
                            <a href="{{ route('cart.checkout') }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                ดำเนินการสั่งซื้อ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">ตะกร้าของคุณว่างเปล่า</h3>
                <p class="text-gray-500 mb-6">เพิ่มสินค้าที่คุณต้องการลงในตะกร้า</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700">
                    เลือกสินค้า
                </a>
            </div>
        @endif
    @endauth
</div>
@endsection