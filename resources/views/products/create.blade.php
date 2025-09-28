@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
	<h1 class="text-2xl font-bold mb-6 text-center">เพิ่มสินค้าใหม่</h1>
	@if ($errors->any())
		<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
			<ul class="list-disc pl-5">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
		@csrf
		<div>
			<label for="name" class="block font-medium mb-1">ชื่อสินค้า</label>
			<input type="text" name="name" id="name" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}" required>
		</div>
		<div>
			<label for="description" class="block font-medium mb-1">รายละเอียด</label>
			<textarea name="description" id="description" rows="3" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
		</div>
		<div>
			<label for="price" class="block font-medium mb-1">ราคา (บาท)</label>
			<input type="number" name="price" id="price" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('price') }}" step="0.01" required>
		</div>
		<div>
			<label for="image" class="block font-medium mb-1">รูปสินค้า</label>
			<input type="file" name="image" id="image" class="w-full border-gray-300 rounded px-3 py-2" accept="image/*" onchange="previewImage(event)">
			<div class="mt-3">
				<img id="preview" src="#" alt="Preview" class="hidden h-40 rounded border mx-auto" />
			</div>
		</div>
		<div class="flex justify-between items-center">
			<a href="{{ route('products.index') }}" class="text-gray-600 hover:underline font-semibold px-4 py-2 rounded border border-gray-300 bg-white shadow">ย้อนกลับ</a>
			<button type="submit" class="bg-green-600 hover:bg-green-700 text-white border border-green-700 px-6 py-2 rounded-lg shadow-lg font-bold text-base transition duration-200" style="background-color:#16a34a !important; color:#fff !important; border:2px solid #15803d !important;">บันทึกสินค้า</button>
		</div>
	</form>
</div>
@endsection

@push('scripts')
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
