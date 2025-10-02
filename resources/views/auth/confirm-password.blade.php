<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-10">
            <div class="text-center">
                <div class="mx-auto h-24 w-24 rounded-2xl bg-white shadow-lg flex items-center justify-center p-3">
                    <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    ยืนยันรหัสผ่าน
                </h2>
                <p class="mt-4 text-center text-sm text-gray-600">
                    นี่คือพื้นที่ปลอดภัยของแอปพลิเคชัน โปรดยืนยันรหัสผ่านของคุณก่อนดำเนินการต่อ
                </p>
            </div>

            <form class="mt-10 space-y-8" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">รหัสผ่าน</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="appearance-none rounded-xl relative block w-full px-4 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-base" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-10">
                    <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-base font-medium rounded-xl text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 shadow-lg hover:shadow-xl">
                        ยืนยัน
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>