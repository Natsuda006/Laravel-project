<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

</head>
<body class="font-sans antialiased">
    
    <!-- ปุ่มกลับจะลอยอยู่เหนือเนื้อหาจาก $slot (z-50 เพื่อให้สูงที่สุด) -->
    <div class="absolute top-6 left-6 z-50">
        <a href="/" 
           class="flex items-center px-4 py-2 rounded-full bg-pink-600 text-white font-semibold 
                  shadow-md hover:bg-pink-700 hover:shadow-lg transition duration-300">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7M3 12h18" />
            </svg>
            กลับสู่หน้าหลัก
        </a>
    </div>

    <!-- ปล่อยให้ $slot (หน้า Login ของคุณ) ควบคุมการแสดงผลทั้งหมด -->
    {{ $slot }}
    
</body>
</html>