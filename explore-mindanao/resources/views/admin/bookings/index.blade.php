@extends('admin.layout')

@section('title', 'Manage Bookings')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Bookings</h2>

    <!-- Tabs for Booking Status -->
    <div class="mb-6">
        <ul class="flex border-b">
            <li class="mr-1">
                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="inline-block py-2 px-4 rounded-t-lg {{ request('status') === 'pending' || !request('status') ? 'bg-blue-500 text-white font-bold' : 'hover:bg-gray-100 text-gray-700' }}">
                    Pending
                </a>
            </li>
            <li class="mr-1">
                <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" class="inline-block py-2 px-4 rounded-t-lg {{ request('status') === 'confirmed' ? 'bg-green-500 text-white font-bold' : 'hover:bg-gray-100 text-gray-700' }}">
                    Confirmed
                </a>
            </li>
            <li class="mr-1">
                <a href="{{ route('admin.bookings.index', ['status' => 'declined']) }}" class="inline-block py-2 px-4 rounded-t-lg {{ request('status') === 'declined' ? 'bg-red-500 text-white font-bold' : 'hover:bg-gray-100 text-gray-700' }}">
                    Declined
                </a>
            </li>
        </ul>
    </div>

    <!-- Bookings Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number of People</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->date }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->per_head }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">₱{{ number_format($booking->total, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        @if ($booking->status === 'pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.bookings.confirm', ['id' => $booking->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="type" value="booking">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Confirm
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.decline', ['id' => $booking->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="type" value="booking">
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-gray-500">{{ ucfirst($booking->status) }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                    @if(empty($bookingsPackages) || count($bookingsPackages) === 0)
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No bookings found.</td>
                    </tr>
                    @endif
                @endforelse
                
                @foreach($bookingsPackages ?? [] as $bookingPackage)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $bookingPackage->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $bookingPackage->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $bookingPackage->phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $bookingPackage->booking_date }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">-</td> <!-- No per_head for package bookings -->
                    <td class="px-6 py-4 text-sm text-gray-900">₱{{ number_format($bookingPackage->package->price ?? 0, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        @if ($bookingPackage->status === 'pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.bookings.confirm', ['id' => $bookingPackage->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="type" value="package">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Confirm
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.decline', ['id' => $bookingPackage->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="type" value="package">
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-gray-500">{{ ucfirst($bookingPackage->status) }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
