<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{

    public function index(Request $request)
    {
        // 1) ჩართე correct locale
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);

        // 2) დააეგერე საწყისი კატეგორიები, children და products,
        //    პროგნოზირებულად მათი ტრანსლაციები
        $query = Category::with([
            'translations'                     => fn($q) => $q->where('locale', $locale),
            'children.translations'            => fn($q) => $q->where('locale', $locale),
            'children.children.translations'   => fn($q) => $q->where('locale', $locale),
            'products.translations'            => fn($q) => $q->where('locale', $locale),
        ])
            ->whereNull('parent_id')
            ->orderBy('rank');

        $paginator = $query->paginate(15);

        // 3) დააბრუნე MenuCollection
        return new MenuCollection($paginator);
    }
}
