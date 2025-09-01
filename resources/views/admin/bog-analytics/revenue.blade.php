@extends('layouts.app')

@section('title', 'BOG Revenue Analytics')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">📈 BOG Revenue Analytics</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bog-analytics.dashboard') }}">BOG Analytics</a></li>
                    <li class="breadcrumb-item active">Revenue</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.bog-analytics.dashboard') }}" class="btn btn-outline-secondary">
                📊 Analytics
            </a>
            <a href="{{ route('admin.bog-analytics.transactions') }}" class="btn btn-outline-primary">
                💳 ტრანზაქციები
            </a>
        </div>
    </div>

    <!-- Revenue Chart Component -->
    @livewire('admin.revenue-chart')
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .container-fluid {
        max-width: 100%;
        padding: 0 1.5rem;
    }
    
    .revenue-chart {
        font-family: inherit;
    }
    
    /* Chart container improvements */
    .chart-container {
        position: relative;
        height: 400px;
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Top restaurants styling */
    .top-restaurants {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Export buttons */
    .export-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .export-buttons {
            justify-content: center;
            width: 100%;
        }
    }
    
    /* Loading overlay */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        z-index: 10;
    }
</style>
@endpush

@push('scripts')
<script>
// Auto-refresh charts every 60 seconds
setInterval(function() {
    if (typeof Livewire !== 'undefined') {
        Livewire.emit('refreshCharts');
    }
}, 60000);

// Chart interaction events
document.addEventListener('livewire:initialized', () => {
    Livewire.on('chartDataUpdated', () => {
        // Trigger chart update
        if (typeof Livewire !== 'undefined') {
            Livewire.emit('chartUpdated');
        }
    });
    
    Livewire.on('exportStarted', (type) => {
        if (typeof toastr !== 'undefined') {
            toastr.info(`${type.toUpperCase()} ექსპორტი იწყება...`);
        }
    });
    
    Livewire.on('exportCompleted', (type) => {
        if (typeof toastr !== 'undefined') {
            toastr.success(`${type.toUpperCase()} ექსპორტი დასრულდა`);
        }
    });
});

// Fullscreen chart functionality
function toggleFullscreen(elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    if (!document.fullscreenElement) {
        element.requestFullscreen().catch(err => {
            console.error('Error attempting to enable fullscreen:', err);
        });
    } else {
        document.exitFullscreen();
    }
}

// Print functionality
function printChart() {
    const chartCanvas = document.getElementById('mainChart');
    if (!chartCanvas) return;
    
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Revenue Chart</title>');
    printWindow.document.write('<style>body{margin:0;padding:20px;text-align:center;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>FOODLY - Revenue Analytics</h2>');
    printWindow.document.write('<img src="' + chartCanvas.toDataURL() + '" style="max-width:100%;height:auto;">');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
@endpush
