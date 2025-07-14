<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kiosk;

class KioskController extends Controller
{
    public function index(Request $request)
    {
        $query = Kiosk::query();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('identifier', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('ip_address', 'like', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get stats (total counts regardless of search/filter)
        $totalKiosks = Kiosk::count();
        $activeKiosks = Kiosk::where('status', Kiosk::STATUS_ACTIVE)->count();
        $offlineKiosks = Kiosk::where('status', Kiosk::STATUS_OFFLINE)->count();
        $maintenanceKiosks = Kiosk::where('status', Kiosk::STATUS_MAINTENANCE)->count();

        // Get paginated results
        $kiosks = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.kiosks.index', compact('kiosks', 'totalKiosks', 'activeKiosks', 'offlineKiosks', 'maintenanceKiosks'));
    }

    public function create()
    {
        return view('admin.kiosks.create');
    }

    public function store(Request $request)
    {
        $validStatuses = implode(',', array_keys(Kiosk::getStatusOptions()));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:kiosks,identifier',
            'location' => 'nullable|string|max:255',
            'status' => "required|in:{$validStatuses}",
            'ip_address' => 'nullable|ip',
            'mode' => 'required|in:kiosk,admin',
            'content' => 'nullable|string',
        ]);

        $kiosk = Kiosk::create([
            'name' => $request->name,
            'identifier' => $request->identifier,
            'location' => $request->location,
            'status' => $request->status,
            'ip_address' => $request->ip_address,
            'mode' => $request->mode,
            'content' => $request->content,
            'secret' => Str::random(32), // Generate a random secret
        ]);

        return redirect()->route('admin.kiosks.index')
            ->with('success', 'Kiosk created successfully.');
    }

    public function show(Kiosk $kiosk)
    {
        return view('admin.kiosks.show', compact('kiosk'));
    }

    public function edit(Kiosk $kiosk)
    {
        return view('admin.kiosks.edit', compact('kiosk'));
    }

    public function update(Request $request, Kiosk $kiosk)
    {
        $validStatuses = implode(',', array_keys(Kiosk::getStatusOptions()));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:kiosks,identifier,' . $kiosk->id,
            'location' => 'nullable|string|max:255',
            'status' => "required|in:{$validStatuses}",
            'ip_address' => 'nullable|ip',
            'mode' => 'required|in:kiosk,admin',
            'content' => 'nullable|string',
        ]);

        $kiosk->update([
            'name' => $request->name,
            'identifier' => $request->identifier,
            'location' => $request->location,
            'status' => $request->status,
            'ip_address' => $request->ip_address,
            'mode' => $request->mode,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.kiosks.index')
            ->with('success', 'Kiosk updated successfully.');
    }

    public function destroy(Kiosk $kiosk)
    {
        $kiosk->delete();

        return redirect()->route('admin.kiosks.index')
            ->with('success', 'Kiosk deleted successfully.');
    }
}
