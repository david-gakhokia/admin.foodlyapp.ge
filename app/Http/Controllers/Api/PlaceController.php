<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::with('restaurant')->get();
        return response()->json($places);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::with('restaurant')->find($id);
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }
        return response()->json($place);
    }

    public function tables(string $id)
    {
        $place = Place::with('tables')->find($id);
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }
        return response()->json($place);
    }


}
