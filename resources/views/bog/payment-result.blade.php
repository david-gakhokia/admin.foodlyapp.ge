@extends('layouts.app')

@section('title', 'გადახდის შედეგი')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            @if($success)
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    წარმატება!
                </h2>
                <p class="text-green-600 text-lg font-medium">
                    {{ $message }}
                </p>
            @else
                <!-- Error Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    შეცდომა
                </h2>
                <p class="text-red-600 text-lg font-medium">
                    {{ $message }}
                </p>
            @endif
        </div>

        @if(isset($transaction) && isset($reservation))
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4">
            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    რეზერვაციის დეტალები
                </h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">რეზერვაცია #:</span>
                        <span class="font-medium">{{ $reservation->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">სახელი:</span>
                        <span class="font-medium">{{ $reservation->guest_name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">თარიღი:</span>
                        <span class="font-medium">{{ $reservation->reservation_datetime?->format('Y-m-d H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">სტატუსი:</span>
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ is_object($reservation->status) ? $reservation->status->getColorClass() : 'bg-gray-100 text-gray-800' }}">
                            {{ is_object($reservation->status) ? $reservation->status->getLabel() : $reservation->status }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    გადახდის დეტალები
                </h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">თანხა:</span>
                        <span class="font-medium">{{ $transaction->amount }} {{ $transaction->currency }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">ტრანსაქცია #:</span>
                        <span class="font-medium">{{ $transaction->bog_order_id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">გადახდის დრო:</span>
                        <span class="font-medium">{{ $transaction->paid_at?->format('Y-m-d H:i') ?? 'არ გადახდილა' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">სტატუსი:</span>
                        <span class="px-2 py-1 rounded-full text-xs font-medium">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="text-center space-y-3">
            @if(isset($can_retry) && $can_retry)
                <button onclick="retryPayment()" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    თავიდან ცდა
                </button>
            @endif
            
            <a href="{{ url('/') }}" class="block w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-center">
                მთავარ გვერდზე დაბრუნება
            </a>
        </div>
    </div>
</div>

@if(isset($can_retry) && $can_retry && isset($reservation))
<script>
function retryPayment() {
    fetch(`/bog/payments/initiate/{{ $reservation->id }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.payment_url) {
            window.location.href = data.payment_url;
        } else {
            alert('გადახდის ინიცირება ვერ მოხერხდა: ' + (data.message || 'უცნობი შეცდომა'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('გადახდის ინიცირება ვერ მოხერხდა');
    });
}
</script>
@endif
@endsection
