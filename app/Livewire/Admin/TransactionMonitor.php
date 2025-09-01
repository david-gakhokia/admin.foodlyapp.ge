<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use Carbon\Carbon;

class TransactionMonitor extends Component
{
    use WithPagination;
    
    public $search = '';
    public $statusFilter = 'all';
    public $dateFilter = 'all';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    
    public $showDetails = false;
    public $selectedTransaction = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => 'all'],
        'dateFilter' => ['except' => 'all'],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];
    
    protected $listeners = ['refreshTransactions', 'closeDetails'];
    
    public function refreshTransactions()
    {
        $this->dispatch('transactionUpdated', [
            'type' => 'info',
            'message' => 'ტრანზაქციების სია განახლდა'
        ]);
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatedDateFilter()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }
    
    public function viewDetails($transactionId)
    {
        $this->selectedTransaction = BOGTransaction::with('reservation.user')
            ->find($transactionId);
        $this->showDetails = true;
    }
    
    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedTransaction = null;
    }
    
    public function retryTransaction($transactionId)
    {
        $transaction = BOGTransaction::find($transactionId);
        
        if ($transaction && $transaction->status === 'failed') {
            // TODO: Implement retry logic via BOG Payment Service
            $transaction->update(['status' => 'pending']);
            
            $this->dispatch('transactionRetried', 'ტრანზაქციის განმეორება დაიწყო');
            session()->flash('message', 'ტრანზაქციის განმეორება დაიწყო');
        }
    }
    
    public function refundTransaction($transactionId)
    {
        $transaction = BOGTransaction::find($transactionId);
        
        if ($transaction && $transaction->status === 'completed') {
            // TODO: Implement refund logic via BOG API
            $this->dispatch('refundInitiated', 'ანაზღაურების პროცესი დაიწყო');
            session()->flash('message', 'ანაზღაურების პროცესი დაიწყო');
        }
    }
    
    public function getTransactionsProperty()
    {
        $query = BOGTransaction::with(['reservation'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('bog_order_id', 'like', '%' . $this->search . '%')
                      ->orWhere('bog_payment_id', 'like', '%' . $this->search . '%')
                      ->orWhere('amount', 'like', '%' . $this->search . '%')
                      ->orWhereHas('reservation', function ($resQuery) {
                          $resQuery->where('name', 'like', '%' . $this->search . '%')
                                   ->orWhere('email', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->dateFilter !== 'all', function ($query) {
                switch ($this->dateFilter) {
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                    case 'week':
                        $query->where('created_at', '>=', Carbon::now()->subWeek());
                        break;
                    case 'month':
                        $query->where('created_at', '>=', Carbon::now()->subMonth());
                        break;
                }
            })
            ->orderBy($this->sortBy, $this->sortDirection);
            
        return $query->paginate(20);
    }
    
    public function render()
    {
        return view('livewire.admin.transaction-monitor', [
            'transactions' => $this->transactions
        ]);
    }
}
