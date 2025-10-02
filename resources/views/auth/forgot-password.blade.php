<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-10">
            <div class="text-center">
                <div class="mx-auto h-24 w-24 rounded-2xl bg-white shadow-lg flex items-center justify-center p-3">
                    <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    ลืมรหัสผ่าน?
                </h2>
                <p class="mt-4 text-center text-sm text-gray-600">
                    ไม่มีปัญหา แจ้งอีเมลของคุณให้เราทราบ แล้วเราจะส่งลิงก์รีเซ็ตรหัสผ่านทางอีเมลให้คุณเลือกรหัสผ่านใหม่
                </p>
            </div>

            <!-- Session Status -->
            <div class="mt-10">
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form class="mt-8 space-y-8" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">อีเมล</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-xl relative block w-full px-4 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-base" placeholder="your@email.com" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-base font-medium rounded-xl text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 shadow-lg hover:shadow-xl">
                            ส่งลิงก์รีเซ็ตรหัสผ่าน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>