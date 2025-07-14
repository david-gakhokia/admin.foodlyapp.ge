<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;

class PhotoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:5120',
        ]);

        // ⛳ ვერსია რომელსაც ნამდვილად იმუშავებს
        \Cloudinary\Configuration\Configuration::instance([
            'cloud_name' => 'dz1ngbazu',
            'api_key'    => '699449233987844',
            'api_secret' => 'd-PWaN-vwuuraT1vMWy8dbn1H88',
            'secure'     => true
        ]);

        try {
            $uploaded = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'foodly/form-test']
            );

            $url = $uploaded->getSecurePath();

            \App\Models\Photo::create([
                'title' => $request->input('title'),
                'image_url' => $url,
            ]);

            return redirect('/upload-photo')->with('success', '✅ Photo uploaded!');
        } catch (\Exception $e) {
            return back()->withErrors(['upload' => '❌ ' . $e->getMessage()]);
        }
    }


    // public function store2(Request $request)
    // {
    //     // ვალიდაცია
    //     $request->validate([
    //         'title' => 'nullable|string|max:255',
    //         'image' => 'required|image|max:5120',
    //     ]);

    //     // Cloudinary პირდაპირი კონფიგურაცია (გარეშე .env)
    //     \Cloudinary\Configuration\Configuration::instance([
    //         'cloud_name' => 'dz1ngbazu',
    //         'api_key'    => '376621574158399',
    //         'api_secret' => 'VCj1w-YDt6FucOwY1wtkN275ZVw',
    //         'secure'     => true
    //     ]);
    //     // Configuration::instance([
    //     //     'cloud_name' => 'dz1ngbazu',
    //     //     'api_key'    => '699449233987844',
    //     //     'api_secret' => 'd-PWaN-vwuuraT1vMWy8dbn1H88',
    //     //     'secure'     => true
    //     // ]);

    //     try {
    //         // ატვირთე სურათი Cloudinary-ზე
    //         $uploaded = Cloudinary::upload(
    //             $request->file('image')->getRealPath(),
    //             ['folder' => 'foodly/manual-form']
    //         );

    //         $url = $uploaded->getSecurePath();

    //         // მონაცემის შენახვა DB-ში
    //         $photo = Photo::create([
    //             'title' => $request->input('title'),
    //             'image_url' => $url,
    //         ]);

    //         // დაბრუნება წარმატების შეტყობინებით
    //         return redirect('/upload-photo')->with('success', 'Photo uploaded successfully!');
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['upload' => $e->getMessage()]);
    //     }
    // }
    public function index()
    {
        return Photo::latest()->get();
    }
}
