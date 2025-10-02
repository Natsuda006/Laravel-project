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
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">เข้าสู่ระบบบัญชีของคุณ</h2>
        <p class="mt-4 text-sm text-gray-600">
          หรือ
          <a href="{{ route('register') }}" class="font-medium text-pink-600 hover:text-pink-500">สร้างบัญชีใหม่</a>
        </p>
      </div>

      <!-- Session Status / Errors -->
      <div class="mt-10">
        <x-auth-session-status class="mb-6" :status="session('status')" />

        @if ($errors->any())
          <div class="mb-8 rounded-lg bg-red-50 p-5 text-red-800">
            <ul class="list-disc pl-5 space-y-2">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Inputs -->
          <div class="space-y-6">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">อีเมล</label>
              <input id="email" name="email" type="email" autocomplete="email" required placeholder="your@email.com" class="appearance-none rounded-xl w-full px-4 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-base" value="{{ old('email') }}">
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">รหัสผ่าน</label>
              <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••" class="appearance-none rounded-xl w-full px-4 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-base">
            </div>
          </div>

          <!-- Remember + Forgot Password -->
          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center">
              <input id="remember_me" name="remember" type="checkbox" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
              <label for="remember_me" class="ml-3 block text-base text-gray-900">จดจำฉัน</label>
            </div>
            <div class="text-base">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-medium text-pink-600 hover:text-pink-500">ลืมรหัสผ่าน?</a>
              @endif
            </div>
          </div>

          <!-- Submit Button -->
          <div class="mt-6 sm:mt-10">
             <button type="submit" class="btn-pastel">เข้าสู่ระบบ</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
