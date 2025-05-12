<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reviews.create')" :active="request()->routeIs('reviews.create')">
                        {{ __('Write a Review') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notification Bell -->
                <div class="relative">
                    <button id="notificationBell" class="relative inline-flex items-center px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 48 48">
                            <path d="M 23.277344 4.0175781 C 15.193866 4.3983176 9 11.343391 9 19.380859 L 9 26.648438 L 6.3496094 31.980469 A 1.50015 1.50015 0 0 0 6.3359375 32.009766 C 5.2696804 34.277268 6.9957076 37 9.5019531 37 L 18 37 C 18 40.295865 20.704135 43 24 43 C 27.295865 43 30 40.295865 30 37 L 38.496094 37 C 41.002339 37 42.730582 34.277829 41.664062 32.009766 A 1.50015 1.50015 0 0 0 41.650391 31.980469 L 39 26.648438 L 39 19 C 39 10.493798 31.863289 3.6133643 23.277344 4.0175781 z M 23.417969 7.0136719 C 30.338024 6.6878857 36 12.162202 36 19 L 36 27 A 1.50015 1.50015 0 0 0 36.15625 27.667969 L 38.949219 33.289062 C 39.128826 33.674017 38.921017 34 38.496094 34 L 9.5019531 34 C 9.077027 34 8.8709034 33.674574 9.0507812 33.289062 C 9.0507812 33.289062 9.0507812 33.287109 9.0507812 33.287109 L 11.84375 27.667969 A 1.50015 1.50015 0 0 0 12 27 L 12 19.380859 C 12 12.880328 16.979446 7.3169324 23.417969 7.0136719 z M 21 37 L 27 37 C 27 38.674135 25.674135 40 24 40 C 22.325865 40 21 38.674135 21 37 z"></path>
                        </svg>
                        <span id="notificationCount" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            @php
                                // Only count booking notifications with user_is_read = 0
                                $bookingsCount = \App\Models\Booking::whereIn('status', ['confirmed', 'declined'])->where('user_is_read', 0)->count();
                                $packagesCount = \App\Models\BookingPackage::whereIn('status', ['confirmed', 'declined'])->where('user_is_read', 0)->count();
                                // Remove review notifications from count
                                $totalCount = $bookingsCount + $packagesCount;
                            @endphp
                            {{ $totalCount }}
                        </span>
                    </button>
                    
                    <!-- Notification Dropdown -->
                    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 shadow-lg rounded-md z-50">
                        <div id="notificationContent" class="p-4">
                            <p class="text-gray-700 dark:text-gray-300">Loading notifications...</p>
                        </div>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('reviews.create')">
                            {{ __('Write a Review') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reviews.create')" :active="request()->routeIs('reviews.create')">
                {{ __('Write a Review') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reviews.create')">
                    {{ __('Write a Review') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('notificationBell').addEventListener('click', function () {
        const dropdown = document.getElementById('notificationDropdown');
        const content = document.getElementById('notificationContent');
        const count = document.getElementById('notificationCount');

        // Toggle dropdown visibility
        dropdown.classList.toggle('hidden');

        // Fetch notifications via AJAX
        if (!dropdown.classList.contains('hidden')) {
            content.innerHTML = '<p class="text-gray-700 dark:text-gray-300">Loading notifications...</p>';
            
            fetch('{{ route('notifications.fetch') }}', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                try {
                    if (data && data.notifications && Array.isArray(data.notifications) && data.notifications.length > 0) {
                        // Add "Mark All as Read" button at the top
                        content.innerHTML = '<div class="flex justify-end mb-2">' +
                            '<button id="markAllAsRead" class="text-blue-500 text-sm font-medium hover:text-blue-700">';
                            
                        content.innerHTML += '<ul class="space-y-2">' + data.notifications.map(notification => {
                            let message = '';
                            try {
                                if (notification.type === 'package') {
                                    message = `Your package booking for ${notification.name || 'Unknown'} was ${notification.status || 'updated'}.`;
                                } else if (notification.type === 'booking') {
                                    message = `Your booking for ${notification.name || 'Unknown'} was ${notification.status || 'updated'}.`;
                                } else {
                                    // Keep this as fallback but don't specifically process review notifications
                                    message = notification.message || 'New notification';
                                }
                            } catch (err) {
                                message = 'Notification available';
                                console.error('Error formatting notification:', err);
                            }
                            
                            return `
                                <li class="text-gray-700 dark:text-gray-300 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                    <div>${message}</div>
                                    <button onclick="markNotificationAsRead('${notification.id}', '${notification.type}')" 
                                            class="text-blue-500 hover:text-blue-700 text-sm">Dismiss</button>
                                </li>
                            `;
                        }).join('') + '</ul>';
                        
                        // Add event listener for the "Mark All as Read" button
                        setTimeout(() => {
                            const markAllBtn = document.getElementById('markAllAsRead');
                            if (markAllBtn) {
                                markAllBtn.addEventListener('click', markAllNotificationsAsRead);
                            }
                        }, 100);
                    } else {
                        content.innerHTML = '<p class="text-gray-700 dark:text-gray-300">No notifications</p>';
                    }
                    
                    // Update notification count
                    if (data && typeof data.unreadCount !== 'undefined') {
                        count.textContent = data.unreadCount > 0 ? data.unreadCount : '';
                        if (data.unreadCount === 0) {
                            count.classList.add('hidden');
                        } else {
                            count.classList.remove('hidden');
                        }
                    }
                } catch (err) {
                    console.error('Error processing notification data:', err);
                    content.innerHTML = '<p class="text-red-500">Error processing notifications</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                content.innerHTML = '<p class="text-red-500">Failed to load notifications. Please try again.</p>';
            });
        }
    });

    function markNotificationAsRead(id, type) {
        fetch('{{ route('notifications.markAsRead') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ id: id, type: type })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh notifications
                document.getElementById('notificationBell').click();
                document.getElementById('notificationBell').click();
            }
        });
    }
    
    // Add function to mark all notifications as read
    function markAllNotificationsAsRead() {
        fetch('{{ route('notifications.markAllAsRead') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh notifications
                document.getElementById('notificationBell').click();
                document.getElementById('notificationBell').click();
            }
        });
    }
</script>
