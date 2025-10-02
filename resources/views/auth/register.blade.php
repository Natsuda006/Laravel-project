<x-guest-layout>
  <div class="min-h-screen w-screen flex items-center justify-center 
              bg-cover bg-center bg-no-repeat"
       style="background-image: url('https://i.pinimg.com/736x/fb/78/55/fb7855e391be57edd2d35e77ae75490e.jpg');">
    
    <div class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl bg-white rounded-2xl shadow-xl p-6 sm:p-10">

      <!-- Logo + Header -->
      <div class="text-center">
        <div class="mx-auto h-24 w-24 rounded-2xl bg-white shadow-lg flex items-center justify-center p-3">
          <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-20 w-20 object-contain">
        </div>
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">สร้างบัญชีใหม่</h2>
        <p class="mt-4 text-sm text-gray-600">
          หรือ
          <a href="{{ route('login') }}" class="font-medium text-pink-600 hover:text-pink-500">เข้าสู่ระบบหากคุณมีบัญชีแล้ว</a>
        </p>
      </div>

      <!-- Errors -->
      <div class="mt-6">
        @if ($errors->any())
          <div class="mb-8 rounded-lg bg-red-50 p-5 text-red-800">
            <ul class="list-disc pl-5 space-y-2">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>

      <!-- Form -->
      <form class="mt-6 sm:mt-8 space-y-6" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ชื่อ-นามสกุล</label>
            <input id="name" name="name" type="text" required placeholder="ชื่อ-นามสกุลของคุณ" value="{{ old('name') }}"
              class="appearance-none rounded-xl w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 
                     focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-base">
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">อีเมล</label>
            <input id="email" name="email" type="email" required autocomplete="email" placeholder="your@email.com" value="{{ old('email') }}"
              class="appearance-none rounded-xl w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 
                     focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-base">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">รหัสผ่าน</label>
            <input id="password" name="password" type="password" required autocomplete="new-password" placeholder="••••••••"
              class="appearance-none rounded-xl w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 
                     focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-base">
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">ยืนยันรหัสผ่าน</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="••••••••"
              class="appearance-none rounded-xl w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 
                     focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-base">
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 sm:mt-8">
          <button type="submit" class="btn-pastel">สร้างบัญชี</button>
        </div>
      </form>

    </div>
  </div>
</x-guest-layout>
