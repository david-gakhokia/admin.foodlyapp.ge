<x-layouts.app :title="'Place Slots Management - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი')">
<div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">დროის ლოტები (TimeSlots)</h1>
        <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            დაბრუნება
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">დღე</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">დრო</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ინტერვალი</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტატუსი</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($table->reservationSlots as $slot)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @switch($slot->day_of_week)
                                @case('Monday') ორშაბათი @break
                                @case('Tuesday') სამშაბათი @break
                                @case('Wednesday') ოთხშაბათი @break
                                @case('Thursday') ხუთშაბათი @break
                                @case('Friday') პარასკევი @break
                                @case('Saturday') შაბათი @break
                                @case('Sunday') კვირა @break
                                @default {{ $slot->day_of_week }}
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($slot->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->time_to)->format('H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $slot->slot_interval_minutes }} წუთი
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($slot->available)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">ხელმისაწვდომია</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">არ არის ხელმისაწვდომი</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">რედ.</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">ლოტები არ არის დამატებული</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layouts.app>