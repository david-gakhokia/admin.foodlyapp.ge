<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\RestaurantDetailsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Place\PlaceResource;
use App\Http\Resources\Place\PlaceShortResource;
use App\Http\Resources\Table\TableResource;
use App\Http\Resources\Menu\MenuCategoryResource;
use App\Http\Resources\Menu\MenuItemResource;

class KioskRestaurantController extends Controller
{
    /**
     * List all restaurants with filtering, sorting and pagination.
     *
     * Supported query params:
     * - search={text}          → ძებნა სახელზე და აღწერაზე
     * - category={slug}        → კატეგორიის ფილტრი (slug)
     * - city={city_name}       → ქალაქის მიხედვით
     * - sort={field}_{dir}     → სორტირება, მაგალითად: rank_asc, discount_rate_desc
     * - per_page={number}      → გვერდზე ელემენტების რაოდენობა
     */
    public function index(Request $request)
    {
        // პარამეტრები
        $perPage = (int) $request->query('per_page', 20);
        $sort    = $request->query('sort', 'rank_asc');
        [$sortField, $sortDir] = explode('_', $sort) + [1 => 'asc'];

        // Query builder-ის შექმნა - მხოლოდ აქტიური რესტორნები
        $query = Restaurant::with(['translations'])
            ->where('status', 'active');

        // 1) Search by name or description
        if ($search = $request->query('search')) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 2) Filter by category slug
        if ($category = $request->query('category')) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // 3) Filter by city (assuming you have a `city` column)
        if ($city = $request->query('city')) {
            $query->where('city', $city);
        }

        // 4) Sorting — whitelist გაფილტრული ველები და მიმართულებები
        $allowedSorts = ['rank', 'discount_rate', 'created_at', 'updated_at'];
        if (! in_array($sortField, $allowedSorts)) {
            $sortField = 'rank';
        }
        $sortDir = strtolower($sortDir) === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sortField, $sortDir);

        // 5) Pagination და Resource-ებით წვდომა
        $restaurants = $query->paginate($perPage);

        return RestaurantShortResource::collection($restaurants)
            ->additional([
                'meta' => [
                    'per_page'     => $restaurants->perPage(),
                    'current_page' => $restaurants->currentPage(),
                    'last_page'    => $restaurants->lastPage(),
                    'total'        => $restaurants->total(),
                ],
            ]);
    }


    public function showBySlug(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();
            return RestaurantResource::make($restaurant);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant details by slug with places and tables
    public function showDetails(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with(['places.tables', 'tables'])
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantResource::make($restaurant),
                    'places' => PlaceShortResource::collection($restaurant->places),
                    'tables' => TableResource::collection($restaurant->tables),
                    'menu' => $restaurant->menuCategories
                        ->whereNull('parent_id')
                        ->values()
                        ->map(function ($parentCategory) use ($restaurant) {
                            return [
                                'category' => new MenuCategoryResource($parentCategory),
                                'children' => $restaurant->menuCategories
                                    ->where('parent_id', $parentCategory->id)
                                    ->values()
                                    ->map(function ($childCategory) use ($restaurant) {
                                        return [
                                            'category' => new MenuCategoryResource($childCategory),
                                            'items' => MenuItemResource::collection(
                                                $restaurant->menuItems->where('menu_category_id', $childCategory->id)->values()
                                            ),
                                        ];
                                    }),
                            ];
                        }),
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }


    public function showByPlaces(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with('places')
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'places' => PlaceResource::collection($restaurant->places)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }

    public function showByPlace(string $slug, $placeIdentifier)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with('places')
                ->firstOrFail();

            // მოძებნეთ place id-ით ან slug-ით
            $place = $restaurant->places
                ->where('id', $placeIdentifier)
                ->first()
                ?? $restaurant->places
                ->where('slug', $placeIdentifier)
                ->first();

            if (!$place) {
                return response()->json(['error' => 'Place not found'], 404);
            }

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'place' => new PlaceResource($place)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch place', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant tables in a specific place by slug and place slug
    public function showTablesInPlace(string $slug, string $place)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with(['places.tables'])
                ->firstOrFail();

            $placeModel = $restaurant->places->where('slug', $place)->first();
            if (!$placeModel) {
                return response()->json(['error' => 'Place not found'], 404);
            }

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'place' => new PlaceShortResource($placeModel),
                    'tables' => TableResource::collection($placeModel->tables)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch tables', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant table in a specific place by slug, place slug, and table slug
    public function showTableInPlace(string $slug, string $place, string $table)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with(['places.tables'])
                ->firstOrFail();

            $placeModel = $restaurant->places->where('slug', $place)->first();
            if (!$placeModel) {
                return response()->json(['error' => 'Place not found'], 404);
            }

            $tableModel = $placeModel->tables->where('id', $table)->first()
                ?? $placeModel->tables->where('slug', $table)->first();

            if (!$tableModel) {
                return response()->json(['error' => 'Table not found'], 404);
            }

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'place' => new PlaceShortResource($placeModel),
                    'table' => new TableResource($tableModel)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch table', 'message' => $e->getMessage()], 500);
        }
    }


    // Get restaurant details by slug with places
    public function showByTables(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with('tables')
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'tables' => TableResource::collection($restaurant->tables)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch Restaurant', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant table details by slug and table id

    public function showTable(string $slug, string $table)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with(['tables' => function ($q) use ($table) {
                    $q->where('id', $table)->orWhere('slug', $table);
                }])
                ->firstOrFail();

            $tableModel = $restaurant->tables->first();

            if (!$tableModel) {
                return response()->json(['error' => 'Table not found'], 404);
            }

            return response()->json([
                'data' => [
                    'restaurant' => RestaurantShortResource::make($restaurant),
                    'table' => new TableResource($tableModel)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch table', 'message' => $e->getMessage()], 500);
        }
    }


    // Get all menu categories related to a restaurant by id or slug
    public function menuCategories(Request $request, $identifier)
    {
        try {
            $restaurant = Restaurant::where('id', $identifier)
                ->orWhere('slug', $identifier)
                ->where('status', 'active')
                ->firstOrFail();

            return response()->json([
                'data' => [
                    'restaurant' => new RestaurantShortResource($restaurant),
                    'menu_categories' => MenuCategoryResource::collection($restaurant->menuCategories)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch menu categories', 'message' => $e->getMessage()], 500);
        }
    }


    public function menuItems(Request $request, $identifier)
    {
        try {
            $restaurant = Restaurant::where('id', $identifier)
                ->orWhere('slug', $identifier)
                ->where('status', 'active')
                ->firstOrFail();

            // თუ გსურთ მხოლოდ აქტიური ელემენტები, დაამატეთ ->where('status', 'active')
            $menuItems = $restaurant->menuItems()->orderBy('rank')->get();

            return response()->json([
                'data' => [
                    'restaurant' => new RestaurantShortResource($restaurant),
                    'menu_items' => MenuItemResource::collection($menuItems)
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch menu items', 'message' => $e->getMessage()], 500);
        }
    }

    // Get restaurant info with menu: parent categories, child categories, and items per category
    public function showMenu(string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with(['menuCategories', 'menuItems'])
                ->firstOrFail();

            // მშობელი კატეგორიები
            $mainCategories = $restaurant->menuCategories
                ->whereNull('parent_id')
                ->values();

            $menuTree = $mainCategories->map(function ($mainCategory) use ($restaurant) {
                // შვილობილი კატეგორიები
                $childCategories = $restaurant->menuCategories
                    ->where('parent_id', $mainCategory->id)
                    ->values();

                return [
                    'parent_category' => new MenuCategoryResource($mainCategory),
                    'children' => $childCategories->map(function ($childCategory) use ($restaurant) {
                        // შვილობილი კატეგორიის პროდუქტები
                        $items = $restaurant->menuItems
                            ->where('menu_category_id', $childCategory->id)
                            ->values();

                        return [
                            'category' => new MenuCategoryResource($childCategory),
                            'items' => MenuItemResource::collection($items),
                        ];
                    }),
                    // მშობელი კატეგორიის პროდუქტები (თუ აქვს)
                    'items' => MenuItemResource::collection(
                        $restaurant->menuItems
                            ->where('menu_category_id', $mainCategory->id)
                            ->values()
                    ),
                ];
            });

            return response()->json([
                'data' => [
                    'restaurant' => new RestaurantShortResource($restaurant),
                    'menu' => $menuTree,
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch menu tree', 'message' => $e->getMessage()], 500);
        }
    }
}
