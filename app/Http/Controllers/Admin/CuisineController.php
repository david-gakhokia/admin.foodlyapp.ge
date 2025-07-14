<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuisine;
use App\Http\Requests\Cuisine\StoreCuisineRequest;
use App\Http\Requests\Cuisine\UpdateCuisineRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use Illuminate\Http\RedirectResponse;

class CuisineController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService
    ) {}

    public function index(Request $request)
    {
        $query = Cuisine::query()->withCount('restaurants');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('slug', 'like', "%{$searchTerm}%")
                  ->orWhereHas('translations', function($translation) use ($searchTerm) {
                      $translation->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        switch ($sortBy) {
            case 'slug':
                $query->orderBy('slug');
                break;
            case 'status':
                $query->orderBy('status');
                break;
            case 'created_at':
                $query->latest();
                break;
            case 'name':
            default:
                $query->orderBy('slug'); // Since name is translatable, we'll order by slug as fallback
                break;
        }

        $cuisines = $query->paginate(10)->withQueryString();
        
        return view('admin.cuisines.index', compact('cuisines'));
    }


    public function create()
    {
        return view('admin.cuisines.create');
    }


    public function store(StoreCuisineRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Prepare basic data
        $data = [
            'status' => $validated['status'],
            'rank' => $validated['rank'] ?? 0,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/cuisines');
        }

        // Generate slug from the default locale name
        $defaultLocale = config('app.locale', 'ka');
        $defaultName = $validated['name'][$defaultLocale] ?? $validated['name']['en'] ?? '';
        $data['slug'] = $this->slugService->generate(new Cuisine, $defaultName);

        // Create cuisine with translations
        $cuisine = Cuisine::create($data);
        
        // Save translations
        if (isset($validated['name'])) {
            foreach ($validated['name'] as $locale => $name) {
                if (!empty($name)) {
                    $translationData = ['name' => $name];
                    if (isset($validated['description'][$locale])) {
                        $translationData['description'] = $validated['description'][$locale];
                    }
                    $cuisine->translateOrNew($locale)->fill($translationData);
                }
            }
            $cuisine->save();
        }

        return redirect()
            ->route('admin.cuisines.index')
            ->with('success', 'Cuisine created successfully.');
    }


    public function update(UpdateCuisineRequest $request, Cuisine $cuisine): RedirectResponse
    {
        $validated = $request->validated();
        
        // Prepare basic data
        $data = [
            'status' => $validated['status'],
            'rank' => $validated['rank'] ?? $cuisine->rank,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($cuisine->image) {
                $publicId = $this->cloudinaryService->extractPublicIdFromUrl($cuisine->image, 'foodly/cuisines');
                $this->cloudinaryService->deleteImage($publicId);
            }
            $data['image'] = $this->cloudinaryService->upload($request->file('image'), 'foodly/cuisines');
        }

        // Generate slug from the default locale name
        $defaultLocale = config('app.locale', 'ka');
        $defaultName = $validated['name'][$defaultLocale] ?? $validated['name']['en'] ?? $cuisine->name;
        $data['slug'] = $this->slugService->generateForUpdate($cuisine, $defaultName, $cuisine->id);

        // Update cuisine
        $cuisine->update($data);
        
        // Update translations
        if (isset($validated['name'])) {
            foreach ($validated['name'] as $locale => $name) {
                if (!empty($name)) {
                    $translationData = ['name' => $name];
                    if (isset($validated['description'][$locale])) {
                        $translationData['description'] = $validated['description'][$locale];
                    }
                    if (isset($validated['meta_title'][$locale])) {
                        $translationData['meta_title'] = $validated['meta_title'][$locale];
                    }
                    if (isset($validated['meta_desc'][$locale])) {
                        $translationData['meta_desc'] = $validated['meta_desc'][$locale];
                    }
                    $cuisine->translateOrNew($locale)->fill($translationData);
                }
            }
            $cuisine->save();
        }

        return redirect()
            ->route('admin.cuisines.index')
            ->with('success', 'Cuisine updated successfully.');
    }




    public function show(string $id)
    {
        //
    }

    public function edit(Cuisine $cuisine)
    {
        // Load translations to ensure they're available
        $cuisine->load('translations');
        
        // Prepare translation data for easier access in the view
        $translationData = [];
        foreach (config('translatable.locales', ['ka', 'en']) as $locale) {
            $translation = $cuisine->translate($locale);
            $translationData[$locale] = [
                'name' => $translation ? $translation->name : '',
                'description' => $translation ? $translation->description : '',
                'meta_title' => $translation ? $translation->meta_title : '',
                'meta_desc' => $translation ? $translation->meta_desc : '',
            ];
        }
        
        return view('admin.cuisines.edit', [
            'cuisine' => $cuisine,
            'locales' => config('translatable.locales', ['ka', 'en']),
            'translationData' => $translationData,
        ]);
    }




    public function destroy(Cuisine $cuisine)
    {
        if ($cuisine->image) {
            $publicId = $this->cloudinaryService->extractPublicIdFromUrl($cuisine->image, 'foodly/cuisines');
            if ($publicId) {
                $this->cloudinaryService->deleteImage($publicId);
            }
        }

        $cuisine->delete();

        return redirect()->route('admin.cuisines.index')->with('success', 'Cuisine deleted successfully.');
    }
}
