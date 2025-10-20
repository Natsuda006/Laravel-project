@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    {{-- การ์ดฟอร์ม --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        @csrf

        {{-- 1. ย้ายหัวข้อมาไว้ข้างใน --}}
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">เพิ่มสินค้าใหม่</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 2. ปรับดีไซน์กล่องข้อความ --}}
        <div>
            <label for="name" class="block font-medium mb-1 text-gray-700">ชื่อสินค้า</label>
            <input type="text" name="name" id="name" class="w-full bg-gray-50 border-gray-200 rounded-lg shadow-sm px-4 py-2 focus:ring-green-500 focus:border-green-500 transition" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="description" class="block font-medium mb-1 text-gray-700">รายละเอียด</label>
            <textarea name="description" id="description" rows="4" class="w-full bg-gray-50 border-gray-200 rounded-lg shadow-sm px-4 py-2 focus:ring-green-500 focus:border-green-500 transition">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price" class="block font-medium mb-1 text-gray-700">ราคา (บาท)</label>
            <input type="number" name="price" id="price" class="w-full bg-gray-50 border-gray-200 rounded-lg shadow-sm px-4 py-2 focus:ring-green-500 focus:border-green-500 transition" value="{{ old('price') }}" step="0.01" required>
        </div>

        <div>
            <label for="image" class="block font-medium mb-1 text-gray-700">รูปสินค้า</label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" accept="image/*" onchange="previewImage(event)">
            <div class="mt-4">
                <img id="preview" src="#" alt="Preview" class="hidden h-40 rounded-lg border mx-auto shadow-sm" />
            </div>
        </div>

        {{-- ส่วนปุ่มยังคงเหมือนเดิม --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline font-semibold px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm transition">ย้อนกลับ</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white border border-green-700 px-6 py-2 rounded-lg shadow-lg font-bold text-base transition duration-200" style="background-color:#16a34a !important; color:#fff !important; border:2px solid #15803d !important;">บันทึกสินค้า</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- ส่วน Script เหมือนเดิม ไม่ต้องแก้ไข --}}
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.classList.add('hidden');
    }
}
</script>
@endpush