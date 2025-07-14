<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantShortResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Restaurant;

class HomeController extends Controller
{
    public function restaurants()
    {
        try {
            $locale = request()->query('locale', app()->getLocale());
            app()->setLocale($locale);

            $restaurants = Restaurant::where('status', '1')->orderBy('rank', 'asc')->take(6)->get();

            if ($restaurants->isEmpty()) {
                return response()->json(['error' => 'No restaurants found'], 404);
            }

            return RestaurantShortResource::collection($restaurants);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch restaurants', 'message' => $e->getMessage()], 500);
        }
    }

    public function categories(Request $request)
    {
        // 1) დააყენეთ Locale მოთხოვნიდან
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);

        // 2) Pagination (Translatable trait ავტომატურად ამოღებს name/description სწორედ ამ locale-ზე)
        $paginator = Category::paginate(15);

        // 3) Resource Collection–ის აბრუნება
        return CategoryResource::collection($paginator)
            ->response()
            ->setStatusCode(200);
    }
}
