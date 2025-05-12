<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Explore Mindanao</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Add minimal Tailwind styles here if needed -->
            <style>
                /* Animation keyframes */
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                
                @keyframes floatIn {
                    from {
                        opacity: 0;
                        transform: translateX(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
                
                @keyframes pulse {
                    0% {
                        box-shadow: 0 0 0 0 rgba(62, 180, 137, 0.4);
                    }
                    70% {
                        box-shadow: 0 0 0 10px rgba(62, 180, 137, 0);
                    }
                    100% {
                        box-shadow: 0 0 0 0 rgba(62, 180, 137, 0);
                    }
                }
                
                /* Tourist spot card animations */
                .tourist-card {
                    animation: fadeInUp 0.6s ease-out forwards;
                    opacity: 0;
                }
                
                .tourist-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
                    transition: all 0.3s ease;
                }
                
                /* Staggered delay for tourist spots */
                .delay-1 { animation-delay: 0.1s; }
                .delay-2 { animation-delay: 0.2s; }
                .delay-3 { animation-delay: 0.3s; }
                .delay-4 { animation-delay: 0.4s; }
                .delay-5 { animation-delay: 0.5s; }
                .delay-6 { animation-delay: 0.6s; }
                .delay-7 { animation-delay: 0.7s; }
                .delay-8 { animation-delay: 0.8s; }
                .delay-9 { animation-delay: 0.9s; }
                .delay-10 { animation-delay: 1s; }
                .delay-11 { animation-delay: 1.1s; }
                
                /* Social media animations */
                .social-icon {
                    animation: floatIn 0.5s ease-out forwards;
                    opacity: 0;
                }
                
                .social-delay-1 { animation-delay: 0.3s; }
                .social-delay-2 { animation-delay: 0.5s; }
                .social-delay-3 { animation-delay: 0.7s; }
                
                /* Pulsing button animation */
                .pulse-button {
                    animation: pulse 2s infinite;
                }
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <!-- Header with Navigation -->
        <header class="w-full max-w-7xl fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-[#0a0a0a]/90 backdrop-blur-sm">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a href="#" class="text-xl font-semibold">Explore Mindanao</a>
                
                <!-- Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="#home" class="font-medium hover:text-[#F53003] transition-colors">Home</a></li>
                        <li><a href="#about" class="font-medium hover:text-[#F53003] transition-colors">About</a></li>
                        <li><a href="#destinations" class="font-medium hover:text-[#F53003] transition-colors">Destinations</a></li>
                        <li><a href="#contact" class="font-medium hover:text-[#F53003] transition-colors">Contact</a></li>
                    </ul>
                </nav>
                
                <!-- Mobile menu button -->
                <button class="md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <div id="home" class="flex items-center justify-center w-full mt-16 transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex flex-col items-center justify-center py-12 text-center w-full">
                <!-- Hero Section -->
                <div class="relative flex flex-col items-center justify-center w-full py-16">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-4 tracking-wider text-center">
                        EXPLORE <br> MINDANAO
                    </h1>
                    <p class="text-lg mb-8 tracking-widest">Dream - Explore - Discover</p>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-[#3EB489] hover:bg-[#2a9e74] text-white font-medium rounded-md transition-colors">
                        Start Travelling
                    </a>
                </div>

              

                <!-- Services Section -->
                <div id="services" class="w-full max-w-6xl mx-auto mt-16 px-4 py-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                        <!-- Discounts -->
                        <div class="flex flex-col items-center p-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3-3 2 2 2-2 2 2 2-2 3 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold">Discounts</h3>
                        </div>
                        <!-- Customer Service -->
                        <div class="flex flex-col items-center p-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold">Customer Service</h3>
                        </div>
                        <!-- Customization -->
                        <div class="flex flex-col items-center p-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold">Customization</h3>
                        </div>
                        <!-- Management -->
                        <div class="flex flex-col items-center p-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M9 7a3 3 0 116 0 3 3 0 01-6 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold">Management</h3>
                        </div>
                    </div>
                </div>

                <!-- Trending Tourist Spots Section -->
                <div id="destinations" class="w-full max-w-6xl mx-auto mt-16 px-4 bg-image py-16">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center">Trending Tourist Spots</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Tourist Spot 1 -->
                        <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-1">
                            <img src="/img/tourist-spot-1.jpg" alt="Tourist Spot 1" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 1</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 1.</p>
                            </div>
                        </div>
                        <!-- Tourist Spot 2 -->
                        <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-2">
                            <img src="/img/tourist-spot-2.jpg" alt="Tourist Spot 2" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 2</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 2.</p>
                            </div>
                        </div>
                        <!-- Tourist Spot 3 -->
                        <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-3">
                            <img src="/img/tourist-spot-3.jpg" alt="Tourist Spot 3" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 3</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 3.</p>
                            </div>
                        </div>
                         <!-- Tourist Spot 4 -->
                         <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-4">
                            <img src="/img/tourist-spot-4.jpg" alt="Tourist Spot 4" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 4</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 4.</p>
                            </div>
                        </div>
                         <!-- Tourist Spot 5 -->
                         <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-5">
                            <img src="/img/tourist-spot-5.jpg" alt="Tourist Spot 5" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 5</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 5.</p>
                            </div>
                        </div>
                         <!-- Tourist Spot 6 -->
                         <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-6">
                            <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 6" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 6</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 6.</p>
                            </div>
                        </div>
                            <!-- Tourist Spot 7 -->
                            <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-7">
                                <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 7" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Tourist Spot 7</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 7.</p>
                                </div>
                            </div>
                                <!-- Tourist Spot 8 -->
                         <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-8">
                            <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 8" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">Tourist Spot 8</h3>
                                <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 8.</p>
                            </div>
                        </div>
                            <!-- Tourist Spot 9 -->
                            <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-9">
                                <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 9" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Tourist Spot 9</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 9.</p>
                                </div>
                            </div>
                                   <!-- Tourist Spot 10 -->
                                   <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-10">
                                    <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 10" class="w-full h-48 object-cover rounded-t-lg">
                                    <div class="p-4">
                                        <h3 class="text-xl font-semibold mb-2">Tourist Spot 10</h3>
                                        <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 10.</p>
                                    </div>
                                </div>
                                       <!-- Tourist Spot 11 -->
                            <div class="bg-white dark:bg-[#161615] p-4 rounded-lg shadow-md tourist-card delay-11">
                                <img src="/img/tourist-spot-6.jpg" alt="Tourist Spot 11" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Tourist Spot 11</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Description of Tourist Spot 11.</p>
                                </div>
                            </div>
                    </div>
                </div>
            </main>
        </div>

          <!-- About Section -->
          <section id="about" class="w-full max-w-6xl mx-auto mt-16 px-4 py-16 text-center">
            <h2 class="text-3xl font-bold mb-8">About Us</h2>
            <p class="text-lg leading-relaxed mb-4">
                At Mindayo, we are passionate about bringing the best of Mindanao to travelers seeking unforgettable experiences. Our mission is to connect people with the breathtaking beauty, rich culture, and diverse landscapes that Mindanao has to offer. We provide a simple and efficient platform where you can explore, discover, and book the perfect vacation to suit your unique preferences.
            </p>
            <p class="text-lg leading-relaxed mb-4">
                Whether you’re dreaming of relaxing on pristine beaches, hiking through lush mountains, or immersing yourself in local traditions, Mindayo makes it easy to plan your getaway. Our platform offers a variety of destinations, accommodations, and activities, ensuring that every traveler can find their ideal escape.
            </p>
            <p class="text-lg leading-relaxed mb-4">
                With a focus on customer satisfaction, we strive to deliver a seamless, stress-free booking experience. Our team is dedicated to making your travel planning as smooth as possible, offering personalized recommendations, secure payment options, and excellent customer support every step of the way.
            </p>
            <p class="text-lg leading-relaxed">
                Explore Mindanao with Mindayo and create memories that will last a lifetime. We’re here to help you make your dream vacation a reality!
            </p>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="w-full max-w-6xl mx-auto my-16 px-4 py-16">
            <h2 class="text-3xl font-bold mb-8 text-center">Get in Touch</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="contact-form">
                    <form class="space-y-4">
                        <div>
                            <input type="text" placeholder="Enter your name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#3EB489]">
                        </div>
                        <div>
                            <input type="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#3EB489]">
                        </div>
                        <div>
                            <input type="text" placeholder="Enter Subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#3EB489]">
                        </div>
                        <div>
                            <button type="submit" class="px-8 py-2 bg-[#3EB489] hover:bg-[#2a9e74] text-white font-medium rounded-md transition-colors">
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-8 space-y-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>mandayoofficial@gmail.com</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>+63 908 891 4444</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>Panabo, Davao del Norte, Philippines, 8M7C+C4P4</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Media Links -->
        <div class="fixed right-4 top-1/2 transform -translate-y-1/2 flex flex-col gap-4">
            <a href="#" class="p-2 rounded-full bg-white dark:bg-[#161615] shadow-md hover:scale-110 transition-transform social-icon social-delay-1" aria-label="Instagram">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
            </a>
            <a href="#" class="p-2 rounded-full bg-white dark:bg-[#161615] shadow-md hover:scale-110 transition-transform social-icon social-delay-2" aria-label="Facebook">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="#" class="p-2 rounded-full bg-white dark:bg-[#161615] shadow-md hover:scale-110 transition-transform social-icon social-delay-3" aria-label="Twitter">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
            </a>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
