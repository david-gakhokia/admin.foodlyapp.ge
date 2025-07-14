<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Space\StoreSpaceRequest;
use App\Http\Requests\Space\UpdateSpaceRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Support\Facades\DB;
use Throwable;

class SpaceController extends Controller
{

    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService,
        protected RankService $rankService
    ) {}


    public function index(Request $request)
    {
        $query = Space::with('translations')->withCount('restaurants');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('slug', 'like', "%{$searchTerm}%")
                  ->orWhere('status', 'like', "%{$searchTerm}%")
                  ->orWhereHas('translations', function ($translationQuery) use ($searchTerm) {
                      $translationQuery->where('name', 'like', "%{$searchTerm}%")
                          ->orWhere('description', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort', 'rank');
        switch ($sortBy) {
            case 'name':
                // For translatable names, we'll sort by slug as fallback
                $query->orderBy('slug');
                break;
            case 'status':
                $query->orderBy('status')->orderBy('rank');
                break;
            case 'created_at':
                $query->latest();
                break;
            case 'rank':
            default:
                $query->orderBy('rank')->orderBy('id');
                break;
        }

        $spaces = $query->paginate(10)->withQueryString();
        
        return view('admin.spaces.index', compact('spaces'));
    }

    public function create()
    {
        return view('admin.spaces.create', [
            'locales' => config('translatable.locales'),
        ]);
    }

    public function store(StoreSpaceRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData();

            // Auto-assign rank if not provided
            $data = $this->rankService->assignRankIfEmpty($data, Space::class);

            // Handle image upload
            if (request()->hasFile('image_file')) {
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/spaces');
            }

            // Generate slug from default locale name
            $defaultLocale = config('app.locale');
            $defaultName = request()->input("{$defaultLocale}.name");
            
            if ((empty($data['slug']) || trim($data['slug']) === '') && $defaultName) {
                $tempSpace = new Space();
                $data['slug'] = $this->slugService->generate($tempSpace, $defaultName);
            }

            // Create the space
            $space = Space::create($data);

            // Handle translations
            $hasTranslations = false;
            foreach (config('translatable.locales') as $locale) {
                $name = request()->input("{$locale}.name");
                $description = request()->input("{$locale}.description");
                
                // Only create translation if name is provided and not empty
                if (!empty($name) && trim($name) !== '') {
                    $translation = $space->translateOrNew($locale);
                    $translation->name = $name;
                    $translation->description = $description ?? '';
                    $translation->save();
                    $hasTranslations = true;
                }
            }

            // Ensure we have at least one translation
            if (!$hasTranslations) {
                throw new \Exception('At least one language name is required.');
            }

            $space->save();

            DB::commit();

            return redirect()
                ->route('admin.spaces.index')
                ->with('success', 'Space created successfully!');

        } catch (Throwable $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create space: ' . $e->getMessage());
        }
    }

    public function show(Space $space)
    {
        return view('admin.spaces.show', compact('space'));
    }

    public function edit(Space $space)
    {
        return view('admin.spaces.edit', [
            'space' => $space,
            'locales' => config('translatable.locales'),
        ]);
    }

    public function update(UpdateSpaceRequest $request, Space $space): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData();

            // Handle image upload
            if (request()->hasFile('image_file')) {
                // Delete old image if exists
                if ($space->image) {
                    $this->cloudinaryService->deleteImageFromUrl($space->image, 'foodly/spaces');
                }
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/spaces');
            }

            // Generate slug if it's being updated
            if (isset($data['slug']) && (empty($data['slug']) || trim($data['slug']) === '')) {
                $defaultLocale = config('app.locale');
                $defaultName = request()->input("{$defaultLocale}.name");
                if ($defaultName) {
                    $data['slug'] = $this->slugService->generateForUpdate($space, $defaultName, $space->id);
                }
            }

            // Update the space
            $space->update($data);

            // Handle translations
            $hasTranslations = false;
            foreach (config('translatable.locales') as $locale) {
                $name = request()->input("{$locale}.name");
                $description = request()->input("{$locale}.description");
                
                // Only create translation if name is provided and not empty
                if (!empty($name) && trim($name) !== '') {
                    $translation = $space->translateOrNew($locale);
                    $translation->name = $name;
                    $translation->description = $description ?? '';
                    $translation->save();
                    $hasTranslations = true;
                }
            }

            // Ensure we have at least one translation
            if (!$hasTranslations) {
                throw new \Exception('At least one language name is required.');
            }

            $space->save();

            DB::commit();

            return redirect()
                ->route('admin.spaces.index')
                ->with('success', 'Space updated successfully!');

        } catch (Throwable $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update space: ' . $e->getMessage());
        }
    }

    public function destroy(Space $space): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Delete image if exists
            if ($space->image) {
                $this->cloudinaryService->deleteImageFromUrl($space->image, 'foodly/spaces');
            }

            // Delete the space (this will also delete translations)
            $space->delete();

            DB::commit();

            return redirect()
                ->route('admin.spaces.index')
                ->with('success', 'Space deleted successfully!');

        } catch (Throwable $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->with('error', 'Failed to delete space: ' . $e->getMessage());
        }
    }

    /**
     * Delete space image
     */
    public function deleteImage(Space $space): RedirectResponse
    {
        try {
            if ($space->image) {
                $this->cloudinaryService->deleteImageFromUrl($space->image, 'foodly/spaces');
                $space->update(['image' => null]);
                
                return redirect()
                    ->back()
                    ->with('success', 'Image deleted successfully!');
            }

            return redirect()
                ->back()
                ->with('error', 'No image to delete.');

        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete image: ' . $e->getMessage());
        }
    }
}
