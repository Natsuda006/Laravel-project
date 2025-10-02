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
    <body class="font-sans antialiased min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('https://i.pinimg.com/736x/fb/78/55/fb7855e391be57edd2d35e77ae75490e.jpg');">
        <div class="min-h-screen bg-transparent">
            @include('layouts.navigation')
    
        <style>
            .btn-primary {
                background-color: #ff69b4 !important;
                color: white !important;
                border: none !important;
                padding: 0.5rem 1rem !important;
                border-radius: 0.375rem !important;
                font-weight: 500 !important;
                transition: all 0.2s ease-in-out !important;
            }
            
            .btn-primary:hover {
                background-color: #ff1493 !important;
                transform: translateY(-1px) !important;
            }
            
            .btn-secondary {
                background-color: #f8f9fa !important;
                color: #495057 !important;
                border: 1px solid #dee2e6 !important;
                padding: 0.5rem 1rem !important;
                border-radius: 0.375rem !important;
                font-weight: 500 !important;
                transition: all 0.2s ease-in-out !important;
            }
            
            .btn-secondary:hover {
                background-color: #e9ecef !important;
                transform: translateY(-1px) !important;
            }
        </style>


            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-12">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} Collecta. สงวนลิขสิทธิ์.
                    </p>
                </div>
            </footer>
        </div>
        
        @stack('scripts')
    </body>
</html>