<div class="transaction-monitor">
    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <!-- Search -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">🔍 ძებნა</label>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="ტრანზაქციის ID, მომხმარებელი..."
                        class="form-control"
                    >
                </div>

                <!-- Status Filter -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">📊 სტატუსი</label>
                    <select wire:model.live="statusFilter" class="form-select">
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
                <div class="col-md-3 mb-3">
                    <label class="form-label">📅 პერიოდი</label>
                    <select wire:model.live="dateFilter" class="form-select">
                        <option value="all">ყველა პერიოდი</option>
                        <option value="today">დღეს</option>
                        <option value="week">ამ კვირას</option>
                        <option value="month">ამ თვეში</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">📋 დალაგება</label>
                    <select wire:model.live="sortBy" class="form-select">
                        <option value="created_at">შექმნის დრო</option>
                        <option value="amount">თანხა</option>
                        <option value="status">სტატუსი</option>
                        <option value="updated_at">განახლების დრო</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">💳 ტრანზაქციები</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="cursor-pointer" wire:click="sortBy('bog_transaction_id')">
                                ID
                                @if($sortBy === 'bog_transaction_id')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th>მომხმარებელი</th>
                            <th class="cursor-pointer" wire:click="sortBy('amount')">
                                თანხა
                                @if($sortBy === 'amount')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th class="cursor-pointer" wire:click="sortBy('status')">
                                სტატუსი
                                @if($sortBy === 'status')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th>რესტორანი</th>
                            <th class="cursor-pointer" wire:click="sortBy('created_at')">
                                შექმნის დრო
                                @if($sortBy === 'created_at')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th>მოქმედებები</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td class="small font-weight-bold">
                                    {{ Str::limit($transaction->bog_order_id, 15) }}
                                </td>
                                <td>
                                    <div class="small">{{ $transaction->reservation->name ?? 'N/A' }}</div>
                                    <div class="text-muted small">{{ $transaction->reservation->email ?? 'N/A' }}</div>
                                </td>
                                <td class="small">
                                    ₾{{ number_format($transaction->amount, 2) }}
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($transaction->status === 'completed') badge-success
                                        @elseif($transaction->status === 'pending') badge-warning
                                        @elseif($transaction->status === 'processing') badge-info
                                        @elseif($transaction->status === 'failed') badge-danger
                                        @elseif($transaction->status === 'cancelled') badge-secondary
                                        @elseif($transaction->status === 'refunded') badge-purple
                                        @else badge-secondary
                                        @endif
                                    ">
                                        @if($transaction->status === 'completed') დასრულებული
                                        @elseif($transaction->status === 'pending') მიმდინარე
                                        @elseif($transaction->status === 'processing') მუშავდება
                                        @elseif($transaction->status === 'failed') ვერ შესრულდა
                                        @elseif($transaction->status === 'cancelled') გაუქმებული
                                        @elseif($transaction->status === 'refunded') ანაზღაურებული
                                        @else {{ ucfirst($transaction->status) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="small">
                                    @if($transaction->reservation && $transaction->reservation->reservable_type === 'App\\Models\\Restaurant')
                                        {{ $transaction->reservation->reservable?->translateOrNew('ka')?->name ?? 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="small text-muted">
                                    {{ $transaction->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button 
                                            wire:click="viewDetails({{ $transaction->id }})"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            👁️ ნახვა
                                        </button>
                                        
                                        @if($transaction->status === 'failed')
                                            <button 
                                                wire:click="retryTransaction({{ $transaction->id }})"
                                                class="btn btn-outline-warning btn-sm"
                                            >
                                                🔄 განმეორება
                                            </button>
                                        @endif
                                        
                                        @if($transaction->status === 'completed')
                                            <button 
                                                wire:click="refundTransaction({{ $transaction->id }})"
                                                class="btn btn-outline-danger btn-sm"
                                            >
                                                💸 ანაზღაურება
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-credit-card fa-3x mb-3"></i>
                                        <p>ტრანზაქციები ვერ მოიძებნა</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    <!-- Transaction Details Modal - Bootstrap Style -->
    @if($showDetails && $selectedTransaction)
        <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">📋 ტრანზაქციის დეტალები</h5>
                        <button type="button" class="close" wire:click="closeDetails">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Transaction Info -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>BOG Order ID</strong></label>
                                <p class="mb-0">{{ $selectedTransaction->bog_order_id }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>სტატუსი</strong></label>
                                <br>
                                <span class="badge 
                                    @if($selectedTransaction->status === 'completed') badge-success
                                    @elseif($selectedTransaction->status === 'pending') badge-warning
                                    @elseif($selectedTransaction->status === 'failed') badge-danger
                                    @else badge-secondary
                                    @endif
                                ">
                                    {{ ucfirst($selectedTransaction->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>თანხა</strong></label>
                                <p class="mb-0">₾{{ number_format($selectedTransaction->amount, 2) }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>ვალუტა</strong></label>
                                <p class="mb-0">{{ $selectedTransaction->currency }}</p>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        @if($selectedTransaction->reservation)
                            <hr>
                            <h6 class="mb-3">👤 მომხმარებლის ინფორმაცია</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>სახელი</strong></label>
                                    <p class="mb-0">{{ $selectedTransaction->reservation->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><strong>ემაილი</strong></label>
                                    <p class="mb-0">{{ $selectedTransaction->reservation->email }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- BOG Response Data -->
                        @if($selectedTransaction->bog_response_data)
                            <hr>
                            <h6 class="mb-3">📄 BOG Response</h6>
                            <pre class="bg-light p-2 rounded small" style="max-height: 200px; overflow-y: auto;">{{ json_encode($selectedTransaction->bog_response_data, JSON_PRETTY_PRINT) }}</pre>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if($selectedTransaction->status === 'failed')
                            <button 
                                wire:click="retryTransaction({{ $selectedTransaction->id }})"
                                class="btn btn-warning"
                            >
                                🔄 განმეორება
                            </button>
                        @endif
                        
                        @if($selectedTransaction->status === 'completed')
                            <button 
                                wire:click="refundTransaction({{ $selectedTransaction->id }})"
                                class="btn btn-danger"
                            >
                                💸 ანაზღაურება
                            </button>
                        @endif
                        
                        <button 
                            wire:click="closeDetails"
                            class="btn btn-secondary"
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
        <div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 1050;">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
</div>
