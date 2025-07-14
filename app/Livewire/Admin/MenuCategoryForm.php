<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MenuCategory;
use App\Models\Restaurant;
use App\Http\Requests\MenuCategory\MenuCategoryRequest;
use App\Services\CloudinaryService;
use App\Services\SlugService;
use App\Services\RankService;
use Illuminate\Support\Facades\Log;

class MenuCategoryForm extends Component
{
    use WithFileUploads;

    // Form properties
    public $category;
    public $restaurant;
    public $restaurants = [];
    public $parentCategories = [];
    public $isEdit = false;

    // Form fields
    public $restaurant_id = '';
    public $parent_id = '';
    public $slug = '';
    public $status = 'active';
    public $rank = 0;
    public $image;
    public $imageUrl = '';

    // Translation fields
    public $translations = [];

    protected CloudinaryService $cloudinaryService;
    protected SlugService $slugService;
    protected RankService $rankService;

    public function boot(
        CloudinaryService $cloudinaryService,
        SlugService $slugService,
        RankService $rankService
    ) {
        $this->cloudinaryService = $cloudinaryService;
        $this->slugService = $slugService;
        $this->rankService = $rankService;
    }

    public function mount($category = null, $restaurant = null)
    {
        $this->category = $category;
        $this->restaurant = $restaurant;
        $this->isEdit = !is_null($category);
        
        // If restaurant is provided (restaurant-specific context), set it
        if ($this->restaurant) {
            $this->restaurant_id = $this->restaurant->id;
            $this->restaurants = collect([$this->restaurant]); // Only show the current restaurant
        } else {
            // Load all restaurants for general admin context
            $this->restaurants = Restaurant::with('translations')->get();
        }
        
        // Initialize translations for all locales
        foreach (config('translatable.locales') as $locale) {
            $this->translations[$locale] = [
                'name' => '',
                'description' => ''
            ];
        }

        if ($this->isEdit) {
            $this->loadCategoryData();
        } else {
            // For create form, load parent categories if restaurant is set
            if ($this->restaurant_id) {
                $this->loadParentCategories();
            } else {
                $this->parentCategories = collect();
            }
        }
    }

    public function loadCategoryData()
    {
        if (!$this->category) return;

        $this->restaurant_id = $this->category->restaurant_id;
        $this->parent_id = $this->category->parent_id;
        $this->slug = $this->category->slug;
        $this->status = $this->category->status;
        $this->rank = $this->category->rank;
        $this->imageUrl = $this->category->image;

        // Load translations
        foreach (config('translatable.locales') as $locale) {
            $translation = $this->category->translate($locale);
            $this->translations[$locale] = [
                'name' => $translation->name ?? '',
                'description' => $translation->description ?? ''
            ];
        }

        // Load parent categories for the selected restaurant
        $this->loadParentCategories();
    }

    public function updatedRestaurantId()
    {
        // Reset parent category when restaurant changes
        $this->parent_id = '';
        
        // Load parent categories for the new restaurant
        $this->loadParentCategories();
        
        // Show notification
        if ($this->restaurant_id) {
            $count = is_array($this->parentCategories) ? count($this->parentCategories) : $this->parentCategories->count();
            $this->dispatch('show-notification', [
                'message' => $count > 0 ? "✅ Loaded {$count} categories" : 'ℹ️ No categories found for this restaurant',
                'type' => $count > 0 ? 'success' : 'info'
            ]);
        }
    }

    public function loadParentCategories()
    {
        if (!$this->restaurant_id) {
            $this->parentCategories = collect();
            return;
        }

        $query = MenuCategory::where('restaurant_id', $this->restaurant_id)
            ->whereNull('parent_id')
            ->with('translations');

        // Exclude current category in edit mode to prevent circular references
        if ($this->isEdit && $this->category) {
            $query->where('id', '!=', $this->category->id);
        }

        $this->parentCategories = $query->orderBy('rank')->get();
    }

    protected function rules()
    {
        $id = $this->category?->id;

        $rules = [
            'slug' => ['nullable', 'string', 'max:250'],
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rank' => 'nullable|integer|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
            'parent_id' => 'nullable|exists:menu_categories,id',
        ];

        // Add unique slug rule
        if ($id) {
            $rules['slug'][] = 'unique:menu_categories,slug,' . $id;
        } else {
            $rules['slug'][] = 'unique:menu_categories,slug';
        }

        // Add translation rules
        foreach (config('translatable.locales') as $locale) {
            $rules["translations.{$locale}.name"] = 'required|string|max:255';
            $rules["translations.{$locale}.description"] = 'nullable|string';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'slug.unique' => 'ასეთი Slug უკვე არსებობს.',
            'restaurant_id.required' => 'რესტორნის არჩევა აუცილებელია.',
            'status.in' => 'სტატუსი უნდა იყოს active ან inactive.',
            'image.image' => 'სურათი უნდა იყოს გამოსახულების ტიპი.',
            'translations.*.name.required' => 'კატეგორიის სახელი აუცილებელია.',
        ];
    }

    public function save()
    {
        // Validate parent category belongs to same restaurant
        if ($this->parent_id && $this->restaurant_id) {
            $parentCategory = MenuCategory::find($this->parent_id);
            if ($parentCategory && $parentCategory->restaurant_id != $this->restaurant_id) {
                $this->addError('parent_id', 'მშობელი კატეგორია უნდა ეკუთვნოდეს იმავე რესტორანს.');
                return;
            }
        }

        $this->validate();

        try {
            $data = [
                'restaurant_id' => $this->restaurant_id,
                'parent_id' => $this->parent_id ?: null,
                'status' => $this->status,
                'rank' => $this->rank,
                'slug' => $this->slug
            ];

            // Auto-assign rank if not provided
            if (!$this->isEdit) {
                $data = $this->rankService->assignRankIfEmpty($data, MenuCategory::class);
            }

            // Generate slug if empty
            if (empty($data['slug'])) {
                $defaultLocale = config('app.locale');
                $slugName = $this->translations[$defaultLocale]['name'] ?? '';
                if ($this->isEdit) {
                    $data['slug'] = $this->slugService->generateForUpdate(
                        new MenuCategory(),
                        $slugName,
                        $this->category->id
                    );
                } else {
                    $data['slug'] = $this->slugService->generate(new MenuCategory(), $slugName);
                }
            }

            // Handle image upload
            if ($this->image) {
                // Delete old image if exists (edit mode)
                if ($this->isEdit && $this->category->image) {
                    $this->cloudinaryService->deleteImageFromUrl($this->category->image, 'foodly/menu_categories');
                }
                // Upload new image
                $data['image'] = $this->cloudinaryService->upload($this->image, 'foodly/menu_categories');
            }

            if ($this->isEdit) {
                // Update existing category
                $this->category->update($data);
                $category = $this->category;
            } else {
                // Create new category
                $category = MenuCategory::create($data);
            }

            // Handle translations
            if ($this->isEdit) {
                $category->translations()->delete();
            }

            foreach ($this->translations as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $category->translateOrNew($locale)->fill($translation);
                }
            }

            $category->save();

            // Show success message and redirect
            session()->flash('success', $this->isEdit ? 'კატეგორია წარმატებით განახლდა 🔄' : 'კატეგორია წარმატებით დაემატა ✅');
            
            // Redirect based on context
            if ($this->restaurant) {
                return redirect()->route('admin.restaurants.menu.categories.index', $this->restaurant);
            } else {
                return redirect()->route('admin.menu.categories.index');
            }

        } catch (\Exception $e) {
            Log::error('MenuCategory save error: ' . $e->getMessage());
            session()->flash('error', 'შეცდომა მოხდა კატეგორიის შენახვისას.');
        }
    }

    public function render()
    {
        return view('livewire.admin.menu-category-form');
    }
}
