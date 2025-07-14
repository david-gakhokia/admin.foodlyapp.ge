<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // 1) დავალაგოთ locale
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);

        // 2) დავიტვირთოთ მხოლოდ ამ locale-ის თარგმანი და pagination
        $paginator = Product::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }])->paginate(15);

        // 3) დაფილტროთ თითოეული მოდელი, რომ არ დააბრუნოთ მთელი translations მასივი
        $paginator->getCollection()->transform(function (Product $product) {
            return [
                'id'              => $product->id,
                'status'             => $product->status,
                'rank'             => $product->rank,
                'image'             => $product->image,
                'price'           => $product->price,
                'discounted_price' => $product->discounted_price,
                'restaurant_id' => $product->restaurant_id,
                'category_id' => $product->category_id,

                'name'            => $product->name,         // current locale-ის ველი
                'description'     => $product->description,  // current locale-ის ველი
            ];
        });

        // 4) JSON-ით დააბრუნეთ paginator — თვითონ მიხედავს meta-სამხრელ pagination-ს
        return response()->json($paginator);
    }

    public function product_by_restaurantId_lang(Request $request): JsonResponse
    {
        // 1) დავალაგოთ locale
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);

        // 2) მივიღოთ restaurant_id პარამეტრი
        $restaurantId = $request->query('restaurant_id');

        // 3) დავიტვირთოთ მხოლოდ ამ locale-ის თარგმანი და pagination
        $query = Product::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }]);

        // 4) თუ restaurant_id გადმოცემულია, დავფილტროთ
        if ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        }

        $paginator = $query->paginate(15);

        // 5) დაფილტროთ თითოეული მოდელი, რომ არ დააბრუნოთ მთელი translations მასივი
        $paginator->getCollection()->transform(function (Product $product) {
            return [
                'id'              => $product->id,
                'status'          => $product->status,
                'rank'            => $product->rank,
                'image'           => $product->image,
                'price'           => $product->price,
                'discounted_price' => $product->discounted_price,
                'restaurant_id'   => $product->restaurant_id,
                'category_id'     => $product->category_id,

                'name'            => $product->name,         // current locale-ის ველი
                'description'     => $product->description,  // current locale-ის ველი
            ];
        });

        // 6) JSON-ით დააბრუნეთ paginator — თვითონ მიხედავს meta-სამხრელ pagination-ს
        return response()->json($paginator);
    }

    public function all_product_by_restaurantId(Request $request): JsonResponse
    {
        // 1) დავალაგოთ locale
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);
    
        // 2) მივიღოთ restaurant_id პარამეტრი
        $restaurantId = $request->query('restaurant_id');
    
        // 3) დავიტვირთოთ მხოლოდ ამ locale-ის თარგმანი
        $query = Product::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }]);
    
        // 4) თუ restaurant_id გადმოცემულია, დავფილტროთ
        if ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        }
    
        // 5) ყველა ჩანაწერის წამოღება
        $products = $query->get();
    
        // 6) დაფილტროთ თითოეული მოდელი, რომ არ დააბრუნოთ მთელი translations მასივი
        $products->transform(function (Product $product) {
            return [
                'id'              => $product->id,
                'status'          => $product->status,
                'rank'            => $product->rank,
                'image'           => $product->image,
                'price'           => $product->price,
                'discounted_price'=> $product->discounted_price,
                'category_id'     => $product->category_id,
    
                'name'            => $product->name,         // current locale-ის ველი
                'description'     => $product->description,  // current locale-ის ველი
            ];
        });
    
        // 7) JSON-ით დააბრუნეთ ყველა ჩანაწერი
        return response()->json($products);
    }


    public function all_data_product_by_restaurantId(Request $request, $restaurantId): JsonResponse
    {
        // 1) დავიტვირთოთ ყველა თარგმანი (translations) და ფილტრაცია restaurant_id-ზე
        $query = Product::with('translations')->where('restaurant_id', $restaurantId);
    
        // 2) ყველა ჩანაწერის წამოღება
        $products = $query->get();
    
        // 3) დაფილტროთ თითოეული მოდელი, რომ ყველა თარგმანი (translations) დავაბრუნოთ
        $products->transform(function (Product $product) {
            return [
                'id'              => $product->id,
                'status'          => $product->status,
                'rank'            => $product->rank,
                'image'           => $product->image,
                'price'           => $product->price,
                'discounted_price'=> $product->discounted_price,
                'unit' => $product->unit,
                'category_id'     => $product->category_id,
    
                // ყველა თარგმანი
                'translations'    => $product->translations->map(function ($translation) {
                    return [
                        'locale'      => $translation->locale,
                        'name'        => $translation->name,
                        'description' => $translation->description,
                    ];
                }),
            ];
        });
    
        // 4) JSON-ით დააბრუნეთ ყველა ჩანაწერი
        return response()->json($products);
    }

    public function paginate_data_product_by_restaurantId(Request $request, $restaurantId): JsonResponse
    {
        // 1) დავიტვირთოთ ყველა თარგმანი (translations) და ფილტრაცია restaurant_id-ზე
        $query = Product::with('translations')->where('restaurant_id', $restaurantId);
    
        // 2) ჩანაწერების პაგინაცია (10 ჩანაწერი თითო გვერდზე)
        $paginator = $query->paginate(10);
    
        // 3) დაფილტროთ თითოეული მოდელი, რომ ყველა თარგმანი (translations) დავაბრუნოთ
        $paginator->getCollection()->transform(function (Product $product) {
            return [
                'id'              => $product->id,
                'status'          => $product->status,
                'rank'            => $product->rank,
                'image'           => $product->image,
                'price'           => $product->price,
                'discounted_price'=> $product->discounted_price,
                'unit'            => $product->unit,
                'category_id'     => $product->category_id,
    
                // ყველა თარგმანი
                'translations'    => $product->translations->map(function ($translation) {
                    return [
                        'locale'      => $translation->locale,
                        'name'        => $translation->name,
                        'description' => $translation->description,
                    ];
                }),
            ];
        });
    
        // 4) JSON-ით დააბრუნეთ პაგინირებული მონაცემები
        return response()->json($paginator);
    }
    
}
