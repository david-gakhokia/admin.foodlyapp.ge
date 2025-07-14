<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Spot\StoreSpotRequest;
use App\Http\Requests\Spot\UpdateSpotRequest;
use App\Models\Spot;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SpotController extends Controller
{
    protected CloudinaryService $cloudinaryService;
    protected SlugService $slugService;
    protected RankService $rankService;

    public function __construct(
        CloudinaryService $cloudinaryService, 
        SlugService $slugService,
        RankService $rankService
    ) {
        $this->cloudinaryService = $cloudinaryService;
        $this->slugService = $slugService;
        $this->rankService = $rankService;
    }

    public function index(Request $request)
    {
        $query = Spot::translatedIn(app()->getLocale())
            ->with('translations');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $spots = $query->orderBy('rank', 'asc')
                      ->orderBy('created_at', 'desc')
                      ->paginate(12);

        // Get statistics
        $statistics = [
            'total' => Spot::count(),
            'active' => Spot::where('status', 'active')->count(),
            'inactive' => Spot::where('status', 'inactive')->count(),
            'total_restaurants' => DB::table('restaurant_spot')->count(),
        ];

        return view('admin.spots.index', compact('spots', 'statistics'));
    }

    public function create()
    {
        return view('admin.spots.create');
    }

    public function store(StoreSpotRequest $request)
    {
        $data = $request->validatedData();

        DB::beginTransaction();
        try {
            // Auto-assign rank if not provided
            $data = $this->rankService->assignRankIfEmpty($data, Spot::class);

            // Handle file upload using CloudinaryService
            if (request()->hasFile('image_file')) {
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/spots');
            }

            // Extract translations
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Generate slug using SlugService from English name
            $defaultLocale = config('app.locale');
            $slugName = $translations[$defaultLocale]['name'] ?? '';
            $data['slug'] = $this->slugService->generate(new Spot(), $slugName);

            // Create spot
            $spot = Spot::create($data);

            // Add translations
            foreach ($translations as $locale => $translationData) {
                if (!empty($translationData['name'])) {
                    $spot->translateOrNew($locale)->fill($translationData);
                }
            }
            $spot->save();

            DB::commit();

            return redirect()
                ->route('admin.spots.index')
                ->with('success', 'Spot created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->with('error', 'Error creating spot: ' . $e->getMessage());
        }
    }

    public function show(Spot $spot)
    {
        $spot->load(['translations', 'restaurants' => function($query) {
            $query->withPivot(['rank', 'status'])
                  ->withTimestamps()
                  ->orderBy('pivot_rank', 'ASC');
        }]);

        // Get statistics for this spot
        $statistics = [
            'total_restaurants' => $spot->restaurants->count(),
            'active_restaurants' => $spot->restaurants->where('pivot.status', 'active')->count(),
            'inactive_restaurants' => $spot->restaurants->where('pivot.status', 'inactive')->count(),
        ];

        return view('admin.spots.show', compact('spot', 'statistics'));
    }

    public function edit(Spot $spot)
    {
        $spot->load('translations');
        return view('admin.spots.edit', compact('spot'));
    }

    public function update(UpdateSpotRequest $request, Spot $spot)
    {
        $data = $request->validatedData();

        DB::beginTransaction();
        try {
            // Handle file upload using CloudinaryService
            if (request()->hasFile('image_file')) {
                // Delete old image if it exists
                if ($spot->image) {
                    $this->cloudinaryService->deleteImageFromUrl($spot->image, 'foodly/spots');
                }
                
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/spots');
            }

            // Extract translations
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Update slug if English name changed using SlugService
            $defaultLocale = config('app.locale');
            $currentName = $spot->translate($defaultLocale)?->name;
            $newName = $translations[$defaultLocale]['name'] ?? '';
            
            if ($currentName !== $newName) {
                $data['slug'] = $this->slugService->generateForUpdate($spot, $newName, $spot->id);
            }

            // Update spot
            $spot->update($data);

            // Clear existing translations and add new ones
            $spot->translations()->delete();
            foreach ($translations as $locale => $translationData) {
                if (!empty($translationData['name'])) {
                    $spot->translateOrNew($locale)->fill($translationData);
                }
            }
            $spot->save();

            DB::commit();

            return redirect()
                ->route('admin.spots.index')
                ->with('success', 'Spot updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->with('error', 'Error updating spot: ' . $e->getMessage());
        }
    }

    public function destroy(Spot $spot)
    {
        try {
            DB::beginTransaction();

            // Check if spot has attached restaurants
            if ($spot->restaurants()->exists()) {
                return back()->with('error', 'Cannot delete spot that has attached restaurants. Please remove all restaurants first.');
            }

            // Delete associated image using CloudinaryService
            if ($spot->image_link) {
                $this->cloudinaryService->deleteImageFromUrl($spot->image_link, 'foodly/spots');
            }

            $spot->delete();

            DB::commit();

            return redirect()
                ->route('admin.spots.index')
                ->with('success', 'Spot deleted successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting spot: ' . $e->getMessage());
        }
    }

    // Toggle status
    public function toggleStatus(Spot $spot)
    {
        try {
            $spot->update([
                'status' => $spot->status === 'active' ? 'inactive' : 'active'
            ]);

            $status = $spot->status === 'active' ? 'activated' : 'deactivated';
            return response()->json([
                'success' => true,
                'message' => "Spot {$status} successfully!",
                'status' => $spot->status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update rank
    public function updateRank(Request $request, Spot $spot)
    {
        $request->validate([
            'rank' => 'required|integer|min:0'
        ]);

        try {
            $spot->update(['rank' => $request->rank]);

            return response()->json([
                'success' => true,
                'message' => 'Rank updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating rank: ' . $e->getMessage()
            ], 500);
        }
    }
}
