<div class="transaction-monitor">
    <!-- Filters -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">🔍 ძებნა</label>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="ტრანზაქციის ID, მომხმარებელი..."
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">📊 სტატუსი</label>
                <select wire:model.live="statusFilter" class="w-full border rounded-lg px-3 py-2">
                    <option value="all">ყველა სტატუსი</option>
                    <option value="pending">მიმდინარე</option>
                    <option value="processing">მუშავდება</option>
                    <option value="completed">დასრულებული</option>
                    <option value="failed">ვერ შესრულდა</option>
                    <option value="cancelled">გაუქმებული</option>
                    <option value="refunded">ანაზღაურებული</option>
                </select>
            </div>

            <!-- Date Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">📅 პერიოდი</label>
                <select wire:model.live="dateFilter" class="w-full border rounded-lg px-3 py-2">
                    <option value="all">ყველა პერიოდი</option>
                    <option value="today">დღეს</option>
                    <option value="week">ამ კვირას</option>
                    <option value="month">ამ თვეში</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">📋 დალაგება</label>
                <select wire:model.live="sortBy" class="w-full border rounded-lg px-3 py-2">
                    <option value="created_at">შექმნის დრო</option>
                    <option value="amount">თანხა</option>
                    <option value="status">სტატუსი</option>
                    <option value="updated_at">განახლების დრო</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">💳 ტრანზაქციები</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('bog_transaction_id')">
                            ID
                            @if($sortBy === 'bog_transaction_id')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            მომხმარებელი
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('amount')">
                            თანხა
                            @if($sortBy === 'amount')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('status')">
                            სტატუსი
                            @if($sortBy === 'status')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            რესტორანი
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('created_at')">
                            შექმნის დრო
                            @if($sortBy === 'created_at')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            მოქმედებები
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ Str::limit($transaction->bog_order_id, 15) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->reservation->name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->reservation->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ₾{{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($transaction->status === 'completed') bg-green-100 text-green-800
                                    @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($transaction->status === 'failed') bg-red-100 text-red-800
                                    @elseif($transaction->status === 'cancelled') bg-gray-100 text-gray-800
                                    @elseif($transaction->status === 'refunded') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($transaction->reservation && $transaction->reservation->reservable_type === 'App\\Models\\Restaurant')
                                    {{ $transaction->reservation->reservable->translateOrNew('ka')->name ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button 
                                    wire:click="viewDetails({{ $transaction->id }})"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    👁️ ნახვა
                                </button>
                                
                                @if($transaction->status === 'failed')
                                    <button 
                                        wire:click="retryTransaction({{ $transaction->id }})"
                                        class="text-yellow-600 hover:text-yellow-900"
                                    >
                                        🔄 განმეორება
                                    </button>
                                @endif
                                
                                @if($transaction->status === 'completed')
                                    <button 
                                        wire:click="refundTransaction({{ $transaction->id }})"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        💸 ანაზღაურება
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                ტრანზაქციები ვერ მოიძებნა
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $transactions->links() }}
        </div>
    </div>

    <!-- Transaction Details Modal -->
    @if($showDetails && $selectedTransaction)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">📋 ტრანზაქციის დეტალები</h3>
                        <button 
                            wire:click="closeDetails"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            ✕
                        </button>
                    </div>

                    <!-- Transaction Info -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">BOG Order ID</label>
                                <p class="text-sm text-gray-900">{{ $selectedTransaction->bog_order_id }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">სტატუსი</label>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($selectedTransaction->status === 'completed') bg-green-100 text-green-800
                                    @elseif($selectedTransaction->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($selectedTransaction->status === 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst($selectedTransaction->status) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">თანხა</label>
                                <p class="text-sm text-gray-900">₾{{ number_format($selectedTransaction->amount, 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ვალუტა</label>
                                <p class="text-sm text-gray-900">{{ $selectedTransaction->currency }}</p>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        @if($selectedTransaction->reservation)
                            <div class="border-t pt-4">
                                <h4 class="font-medium text-gray-900 mb-2">👤 მომხმარებლის ინფორმაცია</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">სახელი</label>
                                        <p class="text-sm text-gray-900">{{ $selectedTransaction->reservation->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">ემაილი</label>
                                        <p class="text-sm text-gray-900">{{ $selectedTransaction->reservation->email }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Reservation Info -->
                        @if($selectedTransaction->reservation)
                            <div class="border-t pt-4">
                                <h4 class="font-medium text-gray-900 mb-2">🍽️ დაჯავშნის ინფორმაცია</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">რესტორანი</label>
                                        <p class="text-sm text-gray-900">
                                            @if($selectedTransaction->reservation->reservable_type === 'App\\Models\\Restaurant')
                                                {{ $selectedTransaction->reservation->reservable->translateOrNew('ka')->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">დაჯავშნის ID</label>
                                        <p class="text-sm text-gray-900">#{{ $selectedTransaction->reservation->id }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="border-t pt-4">
                            <h4 class="font-medium text-gray-900 mb-2">🕒 დროის ინფორმაცია</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">შექმნილია</label>
                                    <p class="text-sm text-gray-900">{{ $selectedTransaction->created_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">განახლებულია</label>
                                    <p class="text-sm text-gray-900">{{ $selectedTransaction->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Response Data -->
                        @if($selectedTransaction->bog_response_data)
                            <div class="border-t pt-4">
                                <h4 class="font-medium text-gray-900 mb-2">📄 BOG Response</h4>
                                <pre class="text-xs bg-gray-100 p-2 rounded overflow-auto max-h-32">{{ json_encode($selectedTransaction->bog_response_data, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-2 mt-6 pt-4 border-t">
                        @if($selectedTransaction->status === 'failed')
                            <button 
                                wire:click="retryTransaction({{ $selectedTransaction->id }})"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm"
                            >
                                🔄 განმეორება
                            </button>
                        @endif
                        
                        @if($selectedTransaction->status === 'completed')
                            <button 
                                wire:click="refundTransaction({{ $selectedTransaction->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm"
                            >
                                💸 ანაზღაურება
                            </button>
                        @endif
                        
                        <button 
                            wire:click="closeDetails"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm"
                        >
                            დახურვა
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('message') }}
        </div>
    @endif
</div>
