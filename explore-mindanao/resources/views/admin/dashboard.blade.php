@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Total Bookings</h3>
        <p class="text-2xl font-bold">{{ $totalBookings }}</p>
        <p class="text-sm text-gray-500">All time bookings</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Total Revenue</h3>
        <p class="text-2xl font-bold">₱{{ number_format($totalRevenue, 2) }}</p>
        <p class="text-sm text-gray-500">From confirmed bookings</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Pending Bookings</h3>
        <p class="text-2xl font-bold">{{ $pendingBookings }}</p>
        <p class="text-sm text-gray-500">Awaiting confirmation</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Total Reviews</h3>
        <p class="text-2xl font-bold">{{ $totalReviews }}</p>
        <p class="text-sm text-gray-500">Customer feedback</p>
    </div>
</div>

<!-- Monthly Sales Chart First -->
<div class="mt-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h5 class="text-lg font-semibold mb-4">Sales Monthly</h5>
        <div id="monthlySalesChart"></div>
    </div>
</div>

<!-- Place Destination and Package Sales Below -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">
    <!-- Destination Sales Chart with Horizontal Scroll -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h5 class="text-lg font-semibold mb-4">Sales per Destination</h5>
        <div class="overflow-x-auto">
            <div id="destinationSalesChart" style="min-width: 100%; @if(count($destinationNames) > 10) min-width: {{ count($destinationNames) * 100 }}px; @endif"></div>
        </div>
    </div>
    
    <!-- Package Sales Chart with Horizontal Scroll -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h5 class="text-lg font-semibold mb-4">Sales per Package</h5>
        <div class="overflow-x-auto">
            <div id="packageSalesChart" style="min-width: 100%; @if(count($packageNames) > 10) min-width: {{ count($packageNames) * 100 }}px; @endif"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Monthly Sales Chart (Line Chart) - Now first
    var monthlySalesOptions = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{
            name: 'Monthly Sales',
            data: @json($monthlySales)
        }],
        xaxis: {
            categories: @json($monthlyMonths),
            title: {
                text: 'Months'
            }
        },
        yaxis: {
            title: {
                text: 'Total Sales (₱)'
            }
        },
        colors: ['#FF5733'],
        tooltip: {
            y: {
                formatter: function (value) {
                    return '₱' + value.toLocaleString('en-PH');
                }
            }
        }
    };
    var monthlySalesChart = new ApexCharts(document.querySelector("#monthlySalesChart"), monthlySalesOptions);
    monthlySalesChart.render();

    // Sales per Destination Chart (Thinner Vertical Bar Chart)
    var destinationSalesOptions = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Sales',
            data: @json($destinationSales)
        }],
        xaxis: {
            categories: @json($destinationNames),
            title: {
                text: 'Destinations'
            }
        },
        yaxis: {
            title: {
                text: 'Sales (₱)'
            }
        },
        colors: ['#1E90FF'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '30%', // Make bars thinner
                endingShape: 'rounded'
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return '₱' + value.toLocaleString('en-PH');
                }
            }
        }
    };
    var destinationSalesChart = new ApexCharts(document.querySelector("#destinationSalesChart"), destinationSalesOptions);
    destinationSalesChart.render();

    // Package Sales Chart (Thinner Vertical Bar Chart)
    var packageSalesOptions = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Package Sales',
            data: @json($packageSales)
        }],
        xaxis: {
            categories: @json($packageNames),
            title: {
                text: 'Packages'
            }
        },
        yaxis: {
            title: {
                text: 'Sales (₱)'
            }
        },
        colors: ['#28a745'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '30%', // Make bars thinner
                endingShape: 'rounded'
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return '₱' + value.toLocaleString('en-PH');
                }
            }
        }
    };
    var packageSalesChart = new ApexCharts(document.querySelector("#packageSalesChart"), packageSalesOptions);
    packageSalesChart.render();
</script>
@endsection
