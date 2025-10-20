@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">ดำเนินการสั่งซื้อ</h1>

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
        <!-- ✅ Grid หลัก -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- ✅ ฝั่งซ้าย: รายการสินค้า + ข้อมูลการจัดส่ง -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- รายการสินค้า -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">รายการสินค้า</h2>
                    
                    <div class="space-y-4">
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <div class="flex items-center border-b border-gray-200 pb-4">
                                @if($item['image'])
                                    <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden">
                                        <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                    </div>
                                @else
                                    <div class="flex-shrink-0 h-16 w-16 rounded-md bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">🛍️</span>
                                    </div>
                                @endif
                                
                                <div class="ml-4 flex-grow">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                                    <p class="text-gray-500 text-sm">จำนวน: {{ $item['quantity'] }}</p>
                                </div>
                                
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($subtotal, 2) }} บาท
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ✅ ข้อมูลการจัดส่ง -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                        🚚 ข้อมูลการจัดส่ง
                    </h2>

                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">ชื่อ</label>
                                <input type="text" name="first_name" id="first_name" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">นามสกุล</label>
                                <input type="text" name="last_name" id="last_name" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">ที่อยู่</label>
                                <textarea name="address" id="address" rows="3" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out"></textarea>
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">อำเภอ/เขต</label>
                                <input type="text" name="city" id="city" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>

                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">จังหวัด</label>
                                <input type="text" name="province" id="province" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>

                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">รหัสไปรษณีย์</label>
                                <input type="text" name="postal_code" id="postal_code" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone" id="phone" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 
                                           shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-300 focus:bg-white 
                                           transition duration-200 ease-in-out">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ✅ ฝั่งขวา: สรุปรายการสั่งซื้อ -->
            <div>
                <div class="bg-white rounded-xl shadow p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">สรุปรายการสั่งซื้อ</h2>

                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span>จำนวนสินค้าทั้งหมด</span>
                            <span>
                                @php $totalQuantity = 0; @endphp
                                @foreach(session('cart') as $item)
                                    @php $totalQuantity += $item['quantity']; @endphp
                                @endforeach
                                {{ $totalQuantity }} ชิ้น
                            </span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <span>ค่าจัดส่ง</span>
                            <span>ฟรี</span>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-2 mt-2">
                            <div class="flex justify-between font-bold">
                                <span>รวมทั้งหมด</span>
                                <span class="text-green-700">{{ number_format($total, 2) }} บาท</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                            ยืนยันการสั่งซื้อ
                        </button>
                    </form>

                    <a href="{{ route('cart.index') }}" class="block mt-3 text-center text-sm text-gray-500 hover:text-gray-700">
                        กลับไปที่ตะกร้า
                    </a>
                </div>
            </div>
        </div>
        <!-- ✅ จบ grid -->
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">ตะกร้าของคุณว่างเปล่า</h3>
                <p class="text-gray-500 mb-6">เพิ่มสินค้าที่คุณต้องการลงในตะกร้า</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    เลือกสินค้า
                </a>
            </div>
        @endif
    @else
        <div class="bg-red-50 border border-red-200 rounded-xl p-8 text-center">
            <div class="text-5xl mb-4">🔒</div>
            <h3 class="text-xl font-medium text-red-800 mb-2">กรุณาเข้าสู่ระบบ</h3>
            <p class="text-red-600 mb-6">คุณต้องเข้าสู่ระบบก่อนจึงจะสามารถทำการสั่งซื้อสินค้าได้</p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                เข้าสู่ระบบ
            </a>
        </div>
    @endauth
</div>
@endsection
