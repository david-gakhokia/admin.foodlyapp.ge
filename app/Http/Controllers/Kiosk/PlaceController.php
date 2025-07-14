<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Http\Resources\Place\PlaceResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlaceController extends Controller
{
    public function index()
    {
        try {
            $places = Place::where('status', 'active')
                ->orderBy('rank', 'asc')
                ->paginate(12);

            if ($places->isEmpty()) {
                return response()->json(['error' => 'No Place found'], 404);
            }

            return PlaceResource::collection($places);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch Places',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
