<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="{{ asset('img/emicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white h-screen fixed">
            <div class="p-4 text-center border-b border-gray-800">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.destinations.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.destinations.create') ? 'bg-gray-800' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                            </svg>
                            <span>Destinations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center justify-between gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.bookings.index') ? 'bg-gray-800' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Bookings</span>
                            </div>
                            @php
                                $pendingBookingsCount = \App\Models\Booking::where('status', 'pending')->count();
                                $pendingPackagesCount = \App\Models\BookingPackage::where('status', 'pending')->count();
                                $totalPendingCount = $pendingBookingsCount + $pendingPackagesCount;
                            @endphp
                            @if ($totalPendingCount > 0)
                                <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $totalPendingCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews.index') }}" class="flex items-center justify-between gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.reviews.index') ? 'bg-gray-800' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <span>Reviews</span>
                            </div>
                            @php
                                // Count only unread review notifications for admins
                                $unreadReviewsCount = auth()->check() && auth()->user()->is_admin ? 
                                    auth()->user()->unreadNotifications->where('type', 'App\Notifications\AdminReviewNotification')->count() : 0;
                            @endphp
                            @if ($unreadReviewsCount > 0)
                                <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $unreadReviewsCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.packages.index') ? 'bg-gray-800' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                            </svg>
                            <span>Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-gray-800 {{ request()->routeIs('admin.reports.index') ? 'bg-gray-800' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16 0v-2a4 4 0 00-4-4h-1a4 4 0 00-4 4v2m4-10a4 4 0 110-8 4 4 0 010 8z" />
                            </svg>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="mt-auto absolute bottom-6 w-full">
                        <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 ml-64">
            <header class="mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
            </header>
            <div>
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
