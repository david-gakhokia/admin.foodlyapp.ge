<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
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
