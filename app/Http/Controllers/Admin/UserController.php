<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with(['roles', 'tokens'])
            ->select('id', 'name', 'email', 'email_verified_at', 'created_at')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    // Show form to create a new user
    public function create(): View
    {
        // ყველა როლის ჩამოტანა
        $roles = \Spatie\Permission\Models\Role::all();
    
        // გადასცე view–ს
        return view('admin.users.create', compact('roles'));
    }

    // Persist the new user
    public function store(Request $request): RedirectResponse
    {
        // ვალიდაცია
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|confirmed|min:8',
            'role'                  => 'required|exists:roles,name',
        ]);
    
        // მომხმარებლის შექმნა
        $user = \App\Models\User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    
        // როლის მორგება
        $user->assignRole($data['role']);
    
        // გადამისამართება სიაში და ფლეშ შეტყობინება
        return redirect()
            ->route('admin.users.index')
            ->with('success', "მომხმარებელი შეიქმნა და მინიჭდა როლი «{$data['role']}»");
    }
    

    // Show form to edit an existing user
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    // Persist updates to the user
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully.');
    }
}