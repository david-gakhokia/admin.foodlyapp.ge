<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dish\StoreDishRequest;
use App\Http\Requests\Dish\UpdateDishRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Support\Facades\DB;
use Throwable;

class DishController extends Controller
{

    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService,
        protected RankService $rankService
    ) {}


    public function index(Request $request)
    {
        $query = Dish::with(['category', 'translations'])->withCount('restaurants');

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

        // Category filter (if applicable)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
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

        $dishes = $query->paginate(10)->withQueryString();
        
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('admin.dishes.create', [
            'locales' => config('translatable.locales', ['ka', 'en']),
        ]);
    }

    public function store(StoreDishRequest $request): RedirectResponse
    {
        $data = $request->validatedData(); // Use validatedData() instead of validated()

        // Auto-assign rank if not provided
        $data = $this->rankService->assignRankIfEmpty($data, Dish::class);

        // Handle image upload
        if (request()->hasFile('image_file')) {
            $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/dishes');
        }

        // Generate slug from default locale
        $defaultLocale = config('app.locale');
        $slugName = $data['translations'][$defaultLocale]['name'] ?? $data['translations']['en']['name'] ?? '';
        $data['slug'] = $this->slugService->generate(new Dish(), $slugName);

        // Extract translations and remove from main data
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // Create dish without translations first
        $dish = Dish::create($data);

        // Now manually add only the translations that have non-empty names
        foreach ($translations as $locale => $translation) {
            if (!empty($translation['name'])) {
                $dish->translateOrNew($locale)->fill($translation);
            }
        }
        
        // Save the translations
        $dish->save();

        return redirect()
            ->route('admin.dishes.index')
            ->with('success', 'კერძი წარმატებით შეიქმნა');
    }




    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', [
            'dish' => $dish,
            'locales' => config('translatable.locales', ['ka', 'en']),
        ]);
    }


    public function update(UpdateDishRequest $request, Dish $dish): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData(); // Use validatedData() instead of validated()

            // Generate new slug
            $defaultLocale = config('app.locale');
            $slugName = $data['translations'][$defaultLocale]['name'] ?? $data['translations']['en']['name'] ?? $dish->name;
            $data['slug'] = $this->slugService->generateForUpdate($dish, $slugName, $dish->id);

            // Handle image upload
            if (request()->hasFile('image_file')) {
                // Delete old image if exists and upload new one
                if ($dish->image) {
                    $this->cloudinaryService->deleteImageFromUrl($dish->image, 'foodly/dishes');
                }
                // Upload new image
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/dishes');
            }
            // If no new image is uploaded, keep the existing image (do nothing)

            // Extract translations and remove from main data
            $translations = $data['translations'] ?? [];
            unset($data['translations']);

            // Update dish without translations first
            $dish->update($data);

            // Clear existing translations that are not in the new data
            $dish->translations()->delete();

            // Now manually add only the translations that have non-empty names
            foreach ($translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $dish->translateOrNew($locale)->fill($translation);
                }
            }
            
            // Save the translations
            $dish->save();

            DB::commit();

            return redirect()
                ->route('admin.dishes.index')
                ->with('success', 'კერძი წარმატებით განახლდა');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'კერძის განახლებისას დაფიქსირდა შეცდომა: ' . $e->getMessage()])
                ->withInput();
        }
    }



    public function destroy(Dish $dish)
    {
        try {
            DB::beginTransaction();

            // Delete associated image
            if ($dish->image) {
                $this->cloudinaryService->deleteImageFromUrl($dish->image, 'foodly/dishes');
            }

            $dish->delete();

            DB::commit();

            return redirect()
                ->route('admin.dishes.index')
                ->with('success', 'კერძი წარმატებით წაიშალა');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'კერძის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }



    public function deleteOnlyImage(Dish $dish): RedirectResponse
    {
        try {
            if ($dish->image) {
                $this->cloudinaryService->deleteImageFromUrl($dish->image, 'foodly/dishes');

                $dish->update(['image' => null]);

                return back()->with('success', 'სურათი წარმატებით წაიშალა');
            }

            return back()->with('info', 'სურათი არ არის დამატებული');
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'სურათის წაშლისას დაფიქსირდა შეცდომა: ' . $e->getMessage()]);
        }
    }
}
