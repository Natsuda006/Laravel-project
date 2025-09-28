@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">แก้ไขสินค้า</h1>
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block font-medium mb-1">ชื่อสินค้า</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('name', $product->name) }}" required>
        </div>
        <div>
            <label for="description" class="block font-medium mb-1">รายละเอียด</label>
            <textarea name="description" id="description" rows="3" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
        </div>
        <div>
            <label for="price" class="block font-medium mb-1">ราคา (บาท)</label>
            <input type="number" name="price" id="price" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>
        <div>
            <label for="image" class="block font-medium mb-1">รูปสินค้า (ถ้าไม่เปลี่ยนไม่ต้องเลือกใหม่)</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded px-3 py-2">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-32 mt-2 rounded border">
            @endif
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">ย้อนกลับ</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">บันทึกการเปลี่ยนแปลง</button>
        </div>
    </form>
</div>
@endsection
