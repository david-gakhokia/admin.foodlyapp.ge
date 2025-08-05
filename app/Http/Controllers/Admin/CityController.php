<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CityController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected SlugService $slugService,
        protected RankService $rankService
    ) {}

    public function index(Request $request)
    {
        $query = City::with('translations');

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

        $cities = $query->paginate(10)->withQueryString();

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create', [
            'locales' => config('translatable.locales'),
        ]);
    }

    public function store(StoreCityRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData();

            // Auto-assign rank if not provided
            $data = $this->rankService->assignRankIfEmpty($data, City::class);

            // Handle image upload
            if (request()->hasFile('image_file')) {
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/cities');
            }

            // Generate slug from default locale name
            $defaultLocale = config('app.locale');
            $defaultName = request()->input("{$defaultLocale}.name");

            if ((empty($data['slug']) || trim($data['slug']) === '') && $defaultName) {
                $tempCity = new City();
                $data['slug'] = $this->slugService->generate($tempCity, $defaultName);
            }

            // Create the city
            $city = City::create($data);

            // Handle translations
            $hasTranslations = false;
            foreach (config('translatable.locales') as $locale) {
                $name = request()->input("{$locale}.name");
                $description = request()->input("{$locale}.description");
                $metaTitle = request()->input("{$locale}.meta_title");
                $metaDescription = request()->input("{$locale}.meta_description");
                $metaKeywords = request()->input("{$locale}.meta_keywords");

                if (!empty($name) && trim($name) !== '') {
                    $translation = $city->translateOrNew($locale);
                    $translation->name = $name;
                    $translation->description = $description ?? '';
                    $translation->meta_title = $metaTitle ?? '';
                    $translation->meta_description = $metaDescription ?? '';
                    $translation->meta_keywords = $metaKeywords ?? '';
                    $translation->save();
                    $hasTranslations = true;
                }
            }

            if (!$hasTranslations) {
                throw new \Exception('At least one language name is required.');
            }

            $city->save();

            DB::commit();

            return redirect()
                ->route('admin.cities.index')
                ->with('success', 'City created successfully!');
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create city: ' . $e->getMessage());
        }
    }

    public function show(City $city)
    {
        return view('admin.cities.show', compact('city'));
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', [
            'city' => $city,
            'locales' => config('translatable.locales'),
        ]);
    }

    public function update(UpdateCityRequest $request, City $city): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validatedData();

            // Handle image upload
            if (request()->hasFile('image_file')) {
                if ($city->image) {
                    $this->cloudinaryService->deleteImageFromUrl($city->image, 'foodly/cities');
                }
                $data['image'] = $this->cloudinaryService->upload(request()->file('image_file'), 'foodly/cities');
            }

            // Generate slug if it's being updated
            if (isset($data['slug']) && (empty($data['slug']) || trim($data['slug']) === '')) {
                $defaultLocale = config('app.locale');
                $defaultName = request()->input("{$defaultLocale}.name");
                if ($defaultName) {
                    $data['slug'] = $this->slugService->generateForUpdate($city, $defaultName, $city->id);
                }
            }

            $city->update($data);

            // Handle translations
            $hasTranslations = false;
            foreach (config('translatable.locales') as $locale) {
                $name = request()->input("{$locale}.name");
                $description = request()->input("{$locale}.description");
                $metaTitle = request()->input("{$locale}.meta_title");
                $metaDescription = request()->input("{$locale}.meta_description");
                $metaKeywords = request()->input("{$locale}.meta_keywords");

                if (!empty($name) && trim($name) !== '') {
                    $translation = $city->translateOrNew($locale);
                    $translation->name = $name;
                    $translation->description = $description ?? '';
                    $translation->meta_title = $metaTitle ?? '';
                    $translation->meta_description = $metaDescription ?? '';
                    $translation->meta_keywords = $metaKeywords ?? '';
                    $translation->save();
                    $hasTranslations = true;
                }
            }

            if (!$hasTranslations) {
                throw new \Exception('At least one language name is required.');
            }

            $city->save();

            DB::commit();

            return redirect()
                ->route('admin.cities.index')
                ->with('success', 'City updated successfully!');
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update city: ' . $e->getMessage());
        }
    }

    public function destroy(City $city): RedirectResponse
    {
        try {
            DB::beginTransaction();

            if ($city->image) {
                $this->cloudinaryService->deleteImageFromUrl($city->image, 'foodly/cities');
            }

            $city->delete();

            DB::commit();

            return redirect()
                ->route('admin.cities.index')
                ->with('success', 'City deleted successfully!');
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Failed to delete city: ' . $e->getMessage());
        }
    }

    public function deleteImage(City $city): RedirectResponse
    {
        try {
            if ($city->image) {
                $this->cloudinaryService->deleteImageFromUrl($city->image, 'foodly/cities');
                $city->update(['image' => null]);

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
