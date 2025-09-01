@extends('layouts.app')

@section('title', 'BOG Transactions Monitor')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">💳 BOG Transaction Monitor</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bog-analytics.dashboard') }}">BOG Analytics</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.bog-analytics.dashboard') }}" class="btn btn-outline-secondary">
                📊 Analytics
            </a>
            <a href="{{ route('admin.bog-analytics.revenue') }}" class="btn btn-outline-success">
                📈 შემოსავალი
            </a>
        </div>
    </div>

    <!-- Transaction Monitor Component -->
    @livewire('admin.transaction-monitor')
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .container-fluid {
        max-width: 100%;
        padding: 0 1.5rem;
    }
    
    .transaction-monitor {
        font-family: inherit;
    }
    
    /* Table responsiveness */
    .table-responsive {
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Status badges */
    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    /* Modal improvements */
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
    
    /* Loading spinner */
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
    }
</style>
@endpush

@push('scripts')
<script>
// Real-time updates for transaction status
setInterval(function() {
    if (typeof Livewire !== 'undefined') {
        Livewire.emit('refreshTransactions');
    }
}, 15000); // Refresh every 15 seconds

// Toast notifications for transaction updates
document.addEventListener('livewire:initialized', () => {
    Livewire.on('transactionUpdated', (data) => {
        if (typeof toastr !== 'undefined') {
            const { type, message } = data;
            toastr[type](message);
        }
    });
    
    Livewire.on('transactionRetried', (message) => {
        if (typeof toastr !== 'undefined') {
            toastr.info(message);
        }
    });
    
    Livewire.on('refundInitiated', (message) => {
        if (typeof toastr !== 'undefined') {
            toastr.warning(message);
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl+F for search
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        const searchInput = document.querySelector('input[wire\\:model*="search"]');
        if (searchInput) {
            searchInput.focus();
        }
    }
    
    // Escape to close modal
    if (e.key === 'Escape') {
        if (typeof Livewire !== 'undefined') {
            Livewire.emit('closeDetails');
        }
    }
});
</script>
@endpush
