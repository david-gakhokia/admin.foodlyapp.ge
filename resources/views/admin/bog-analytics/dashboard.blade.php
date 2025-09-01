@extends('layouts.app')

@section('title', 'BOG Analytics Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">🏦 BOG Payment Analytics</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">BOG Analytics</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.bog-analytics.transactions') }}" class="btn btn-outline-primary">
                💳 ტრანზაქციები
            </a>
            <a href="{{ route('admin.bog-analytics.revenue') }}" class="btn btn-outline-success">
                📈 შემოსავალი
            </a>
        </div>
    </div>

    <!-- Main Analytics Component -->
    @livewire('admin.payment-analytics')
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .container-fluid {
        max-width: 100%;
        padding: 0 1.5rem;
    }
    
    /* Ensure Tailwind styles work with Bootstrap */
    .payment-analytics {
        font-family: inherit;
    }
    
    /* Custom scrollbar for modal */
    .overflow-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .overflow-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .overflow-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

@push('scripts')
<script>
// Auto-refresh data every 30 seconds
setInterval(function() {
    if (typeof Livewire !== 'undefined') {
        Livewire.emit('refreshData');
    }
}, 30000);

// Show toast notifications for real-time updates
document.addEventListener('livewire:initialized', () => {
    Livewire.on('dataUpdated', (message) => {
        if (typeof toastr !== 'undefined') {
            toastr.info(message || 'მონაცემები განახლდა');
        }
    });
});
</script>
@endpush
