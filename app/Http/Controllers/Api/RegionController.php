<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region; // Assuming you have a Region model
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Region\RegionShortResource;
use App\Http\Resources\Region\RegionResource;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\RestaurantResource;



class RegionController extends Controller
{
    // 1. Get all regions and return as JSON
    public function index()
    {
        try {
            $locale = request()->query('locale', app()->getLocale());
            app()->setLocale($locale);

            $regions = Region::where('status', '1')->orderBy('rank', 'asc')->paginate(12);

            if ($regions->isEmpty()) {
                return response()->json(['error' => 'No restaurants found'], 404);
            }

            return RegionShortResource::collection($regions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch restaurants', 'message' => $e->getMessage()], 500);
        }
    }

    // 2. Get a single region by slug and return as JSON



    public function showBySlug($slug, Request $request)
    {
        try {
            // Step 1: მიიღე ენას locale=ka ან გამოიყენე სისტემის default
            $locale = $request->query('locale', app()->getLocale());
            app()->setLocale($locale);

            // Step 2: მოძებნე რეგიონი slug-ით და თარგმანი ჩათვით
            $region = Region::where('slug', $slug)->firstOrFail();

            // Step 3: გამოაჩინე თარგმნილი ინფორმაცია
            return RegionResource::make($region);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Region not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch region', 'message' => $e->getMessage()], 500);
        }
    }

    // 3. Get restaurants by region slug
    public function restaurantsByRegion($slug)
    {
        try {
            // Step 1: დადგენა locale (სურვილის მიხედვით, locale=ka ან locale=en)
            $locale = request()->query('locale', app()->getLocale());
            app()->setLocale($locale);

            // Step 2: Space მოდელიდან რესტორნების ამოღება, slug-ის მიხედვით
            $region = Region::where('slug', $slug)->firstOrFail();  // თუ space არ მოიძებნა, ის გამოიწვევს ModelNotFoundException

            // Step 3: რესტორნების მატება `RestaurantShortResource`-ით
            $restaurants = $region->restaurants()->orderBy('rank', 'asc')->get();  // თუ რესტორნები არ არის მინიჭებული, $restaurants იქნება ცარიელი

            if ($restaurants->isEmpty()) {  // თუ რესტორნები არ არსებობს, დააბრუნეთ 404
                return response()->json(['error' => 'No restaurants found for this space'], 404);
            }

            // Step 4: RestaurantShortResource-ით მონაცემების გაგზავნა
            return RestaurantShortResource::collection($restaurants);
            // return response()->json($restaurants, 200);
        } catch (ModelNotFoundException $e) {
            // Step 5: თუ Space არ არსებობს, დაბრუნდება შეცდომის პასუხი
            return response()->json(['error' => 'Space not found'], 404);
        } catch (\Exception $e) {
            // Step 6: სხვა შეცდომების დაფიქსირება
            return response()->json(['error' => 'Failed to fetch restaurants', 'message' => $e->getMessage()], 500);
        }
    }

    public function top10RestaurantsByRegion($slug)
    {
        try {
            // Step 1: დადგენა locale (სურვილის მიხედვით, locale=ka ან locale=en)
            $locale = request()->query('locale', app()->getLocale());
            app()->setLocale($locale);

            // Step 2: Space მოდელიდან რესტორნების ამოღება, slug-ის მიხედვით
            $region = Region::where('slug', $slug)->firstOrFail();  // თუ space არ მოიძებნა, ის გამოიწვევს ModelNotFoundException

            // Step 3: რესტორნების მატება `RestaurantShortResource`-ით
            $restaurants = $region->restaurants()->orderBy('rank', 'asc')->take(10)->get();  // თუ რესტორნები არ არის მინიჭებული, $restaurants იქნება ცარიელი

            if ($restaurants->isEmpty()) {  // თუ რესტორნები არ არსებობს, დააბრუნეთ 404
                return response()->json(['error' => 'No restaurants found for this space'], 404);
            }

            // Step 4: RestaurantShortResource-ით მონაცემების გაგზავნა
            return RestaurantShortResource::collection($restaurants);
        } catch (ModelNotFoundException $e) {
            // Step 5: თუ Space არ არსებობს, დაბრუნდება შეცდომის პასუხი
            return response()->json(['error' => 'Space not found'], 404);
        } catch (\Exception $e) {
            // Step 6: სხვა შეცდომების დაფიქსირება
            return response()->json(['error' => 'Failed to fetch restaurants', 'message' => $e->getMessage()], 500);
        }
    }

    public function regions()
    {
        try {
            $locale = request()->query('locale', app()->getLocale());
            app()->setLocale($locale);

            $regions = Region::where('status', '1')->orderBy('rank', 'asc')->paginate(12);

            if ($regions->isEmpty()) {
                return response()->json(['error' => 'No restaurants found'], 404);
            }

            return RegionShortResource::collection($regions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch restaurants', 'message' => $e->getMessage()], 500);
        }
    }

    public function app_showBySlug($slug, Request $request)
    {
        try {
            // Step 1: მიიღე ენას locale=ka ან გამოიყენე სისტემის default
            $locale = $request->query('locale', app()->getLocale());
            app()->setLocale($locale);

            // Step 2: მოძებნე რესტორანი slug-ით და თარგმანი ჩათვით
            $region = Region::where('slug', $slug)->firstOrFail();

            // Step 3: გამოაჩინე თარგმნილი ინფორმაცია
            return $region;
            // return RegionShortResource::make($region);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch restaurant', 'message' => $e->getMessage()], 500);
        }
    }
}
