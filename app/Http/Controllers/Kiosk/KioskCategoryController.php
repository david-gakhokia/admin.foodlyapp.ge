<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryShortResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class KioskCategoryController extends Controller
{
    // 1. Get all Categories
    public function index()
    {
        try {
            $categories = Category::where('status', 1)
                ->orderBy('rank', 'asc')
                ->get();

            if ($categories->isEmpty()) {
                return response()->json(['error' => 'No Categories found'], 404);
            }

            return CategoryShortResource::collection($categories);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // 2. Get a single Category by slug
    public function showBySlug($slug)
    {
        try {
            $category = Category::where('slug', $slug)
                ->where('status', 1)
                ->firstOrFail();
            return new CategoryResource($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Category',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
