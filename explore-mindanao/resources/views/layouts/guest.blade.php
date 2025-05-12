<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/emicon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300 py-10 mt-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Contacts Column -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Contacts</h2>
                        <p class="mb-2">+639088844444</p>
                        <p>lostinyourhersh@gmail.com</p>
                    </div>

                    <!-- Links Column -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Links</h2>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Destinations</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Offers Column -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Offers</h2>
                        <ul class="space-y-2">
                            <li>Discounts</li>
                            <li>Customer Services</li>
                            <li>Customization</li>
                            <li>Management</li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="text-center mt-8 pt-4 border-t border-gray-700">
                    <p>Copyright ©2024 All rights reserved</p>
                </div>
            </div>
        </footer>
    </body>
</html>
