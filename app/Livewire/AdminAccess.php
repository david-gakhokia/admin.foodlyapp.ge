<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminAccess extends Component
{
    public function mount()
    {
        // Check if user is authenticated first
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Then check if user has admin role
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Access denied. Admin privileges required.');
        }
    }

    public function render()
    {
        return view('livewire.admin-access');
    }
}
