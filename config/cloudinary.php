<?php

return [
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],
    'url' => [
        'secure' => true,
    ],
    'upload' => [
        'folder' => 'products',
        'use_filename' => true,
        'unique_filename' => false,
    ],
];