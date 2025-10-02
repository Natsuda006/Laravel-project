<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-10">
            <div class="text-center">
                <div class="mx-auto h-24 w-24 rounded-2xl bg-white shadow-lg flex items-center justify-center p-3">
                    <img src="{{ asset('images/โก้.png') }}" alt="Collecta Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    ยืนยันอีเมลของคุณ
                </h2>
                <p class="mt-4 text-center text-sm text-gray-600">
                    ขอบคุณที่ลงทะเบียน! ก่อนเริ่มต้น คุณสามารถยืนยันที่อยู่อีเมลของคุณได้โดยคลิกลิงก์ที่เราเพิ่งส่งไปให้คุณทางอีเมล หากคุณไม่ได้รับอีเมล เราจะส่งอีเมลอีกฉบับให้คุณด้วยความยินดี
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mt-8 rounded-lg bg-green-50 p-5 text-green-800">
                    ส่งลิงก์ยืนยันใหม่ไปยังที่อยู่อีเมลที่คุณให้ไว้ระหว่างการลงทะเบียนแล้ว
                </div>
            @endif

            <div class="mt-10 space-y-6">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-base font-medium rounded-xl text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 shadow-lg hover:shadow-xl">
                            ส่งอีเมลยืนยันอีกครั้ง
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 shadow hover:shadow-lg">
                        ออกจากระบบ
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>