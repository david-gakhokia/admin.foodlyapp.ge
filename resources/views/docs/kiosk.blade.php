<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiosk API Documentation - Foodly</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Prism.js for syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    
    <style>
        .api-section { scroll-margin-top: 100px; }
        .sticky-nav { position: sticky; top: 0; z-index: 50; }
        body { font-family: 'Inter', sans-serif; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Custom animations */
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    
    <!-- Header -->
    <div class="sticky-nav bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">🏪 Kiosk API</h1>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">v1.0</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Base URL: <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ config('app.url') }}/api/kiosk</code></span>
                    <div class="flex space-x-2">
                        <a href="{{ route('docs.api') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← API Overview</a>
                        <a href="{{ route('docs.webapp') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">WebApp</a>
                        <a href="{{ route('docs.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Full Docs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex gap-8">
            
            <!-- Sidebar Navigation -->
            <div class="w-64 flex-shrink-0">
                <nav class="sticky top-24 space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Kiosk API Endpoints</h3>
                    
                    <div class="space-y-1">
                        <a href="#overview" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📋 Overview</a>
                        <a href="#authentication" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🔐 Authentication</a>
                        <a href="#restaurants" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏡 Restaurants</a>
                        <a href="#menu" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🍽️ Menu System</a>
                        <a href="#spaces" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏢 Spaces</a>
                        <a href="#cuisines" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🍽️ Cuisines</a>
                        <a href="#dishes" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🥘 Dishes</a>
                        <a href="#availability" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🕐 Availability</a>
                        <a href="#spots" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📍 Spots</a>
                        <a href="#categories" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🗂️ Categories</a>
                        <a href="#technical" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">⚙️ Technical</a>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="flex-1 min-w-0">
                
                <!-- Overview Section -->
                <section id="overview" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8 fade-in">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">🏪 Kiosk API Documentation</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Kiosk API არის სპეციალურად კიოსკ ტერმინალებისთვის შექმნილი API endpoint-ების კოლექცია. 
                        ეს API უზრუნველყოფს რესტორნების, სივრცეების, კერძების, მაგიდების და ხელმისაწვდომობის ინფორმაციას.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🔐</span>
                                <h3 class="font-semibold text-blue-900">Authentication</h3>
                            </div>
                            <p class="text-sm text-blue-700">კიოსკის login და authorization</p>
                        </div>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🏡</span>
                                <h3 class="font-semibold text-green-900">Restaurants</h3>
                            </div>
                            <p class="text-sm text-green-700">რესტორნების და მენიუს მართვა</p>
                        </div>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🕐</span>
                                <h3 class="font-semibold text-purple-900">Availability</h3>
                            </div>
                            <p class="text-sm text-purple-700">რეალურ დროში ხელმისაწვდომობა</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <span class="text-yellow-600 mr-2">⚠️</span>
                            <span class="text-yellow-800 font-medium">Authentication Required</span>
                        </div>
                        <p class="text-yellow-700 text-sm mt-1">ყველა kiosk endpoint საჭიროებს authentication token-ს (გარდა login-ისა)</p>
                    </div>
                </section>

                <!-- Authentication Section -->
                <section id="authentication" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🔐 Authentication</h2>
                    
                    <div class="space-y-6">
                        <!-- Kiosk Login -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Kiosk Login</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/login</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Request Body:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "identifier": "kiosk_001",
  "secret": "kiosk_secret_key"
}</code></pre>
                            </div>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Response:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "kiosk": {
    "id": 1,
    "identifier": "kiosk_001",
    "name": "Mall Kiosk 1",
    "location": "East Point Mall",
    "status": "active"
  },
  "token": "2|laravel_sanctum_token_for_kiosk"
}</code></pre>
                            </div>
                        </div>

                        <!-- Other Auth Endpoints -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium">Kiosk Heartbeat</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">/api/kiosk/heartbeat</code>
                                <p class="text-xs text-gray-600 mt-2">🔒 კიოსკის active სტატუსის შენარჩუნება</p>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium">Kiosks Status</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">/api/kiosk/status</code>
                                <p class="text-xs text-gray-600 mt-2">🔒 ყველა კიოსკის სტატუსი</p>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium">Kiosk Config</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">/api/kiosk/config</code>
                                <p class="text-xs text-gray-600 mt-2">🔒 კიოსკის კონფიგურაცია</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Restaurants Section -->
                <section id="restaurants" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🏡 Restaurants</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Restaurants</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">Query Parameters: <code>search, per_page, sort</code></p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurant by Slug</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurant Details</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/details</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurant Places</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/places</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurant Tables</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/tables</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Specific Table</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/table/{table}</code>
                        </div>
                    </div>
                </section>

                <!-- Menu System Section -->
                <section id="menu" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🍽️ Menu System</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Menu Categories</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/menu/categories</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Menu Items</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/menu/items</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Full Menu Structure</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/menu</code>
                            <p class="text-sm text-gray-600 mt-2">აბრუნებს hierarchical menu-ს categories და items-ით</p>
                        </div>
                    </div>
                </section>

                <!-- Spaces Section -->
                <section id="spaces" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🏢 Spaces</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Spaces</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces</code>
                            <p class="text-sm text-gray-600 mt-2">აბრუნებს ყველა აქტიურ სივრცეს rank-ის მიხედვით</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Space by Slug</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces/{slug}</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants by Space</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces/{slug}/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">🔧 <strong>Fixed:</strong> SQL Column Ambiguity - ახლა იყენებს restaurants.status და restaurant_space.rank</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Top 10 Restaurants by Space</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces/{slug}/top-10-restaurants</code>
                        </div>
                    </div>
                </section>

                <!-- Cuisines Section -->
                <section id="cuisines" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🍽️ Cuisines</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Cuisines</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants by Cuisine</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines/{slug}/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">🔧 <strong>Fixed:</strong> იყენებს restaurants.status და cuisine_restaurant.rank</p>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Common Cuisine Slugs:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">georgian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">italian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">asian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">european</code>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Top 10 Restaurants by Cuisine</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines/{slug}/top-10-restaurants</code>
                        </div>
                    </div>
                </section>

                <!-- Dishes Section -->
                <section id="dishes" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🥘 Dishes</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Dishes</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes</code>
                            <p class="text-sm text-gray-600 mt-2">აბრუნებს ყველა კერძს MenuCategory-ების ინფორმაციით</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Dish by Slug</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}</code>
                            <p class="text-sm text-gray-600 mt-2">კერძის დეტალური ინფორმაცია მენიუს კატეგორიებით</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants by Dish</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">Query Parameters: <code>locale</code> (en, ka, ru)</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Top 10 Restaurants by Dish</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}/top-10-restaurants</code>
                        </div>
                    </div>
                </section>

                <!-- Availability Section -->
                <section id="availability" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🕐 Availability</h2>
                    <p class="text-gray-600 mb-6">რესტორნების, სივრცეების და მაგიდების ხელმისაწვდომი საათების API</p>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurant Availability</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/availability/restaurant/{slug}</code>
                            <p class="text-sm text-gray-600 mt-2">Parameters: <code>date</code> (Y-m-d format, optional)</p>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Response Example:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "success": true,
  "data": {
    "restaurant": {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house",
      "timezone": "Asia/Tbilisi"
    },
    "date": "2025-07-20",
    "day_of_week": "Sunday",
    "available_slots": [
      "10:00", "10:30", "11:00", "18:00", "18:30"
    ]
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Place Availability</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Table Availability</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}</code>
                        </div>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-800 mb-3">🔧 Availability Features</h4>
                            <div class="space-y-2 text-sm text-blue-700">
                                <div><strong>რეალურ დროში:</strong> ამოწმებს ფაქტობრივ ჯავშნებს</div>
                                <div><strong>სლოტები:</strong> 30 წუთიანი ინტერვალები</div>
                                <div><strong>კვირეული განრიგი:</strong> თითოეული დღისთვის ცალკე</div>
                                <div><strong>Cache:</strong> 5 წუთით cache-ირება performance-სთვის</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Spots Section -->
                <section id="spots" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📍 Spots</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Spots</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spots</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants by Spot</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spots/{slug}/restaurants</code>
                        </div>
                    </div>
                </section>

                <!-- Categories Section -->
                <section id="categories" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🗂️ Categories</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get All Categories</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/categories</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Category by Slug</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/categories/{slug}</code>
                        </div>
                    </div>
                </section>

                <!-- Technical Details Section -->
                <section id="technical" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">⚙️ Technical Implementation</h2>
                    
                    <div class="space-y-6">
                        <!-- Query Patterns -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium mb-3">🔍 Query Patterns</h4>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Spaces → Restaurants:</p>
                                    <pre class="bg-gray-100 p-3 rounded text-xs font-mono mt-1">$space->restaurants()
    ->where('restaurants.status', 'active')
    ->orderBy('restaurant_space.rank', 'asc')</pre>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Availability Service:</p>
                                    <pre class="bg-gray-100 p-3 rounded text-xs font-mono mt-1">$availabilityService->generateAvailableSlots(
    $restaurant, $date, $dayOfWeek
)</pre>
                                </div>
                            </div>
                        </div>

                        <!-- Performance -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium mb-3">🚀 Performance Features</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2 text-sm">
                                    <h5 class="font-medium text-gray-700">Caching Strategy:</h5>
                                    <ul class="text-gray-600 list-disc list-inside">
                                        <li>რესტორნები: 15 წუთი</li>
                                        <li>ხელმისაწვდომობა: 5 წუთი</li>
                                        <li>კვირეული განრიგი: 1 საათი</li>
                                    </ul>
                                </div>
                                
                                <div class="space-y-2 text-sm">
                                    <h5 class="font-medium text-gray-700">Database Optimization:</h5>
                                    <ul class="text-gray-600 list-disc list-inside">
                                        <li>Indexed slug searches</li>
                                        <li>Eager loading relationships</li>
                                        <li>Optimized pivot queries</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Error Handling -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium mb-3">❌ Error Handling</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm">200</span>
                                    <span class="text-sm text-gray-600">Success</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm">401</span>
                                    <span class="text-sm text-gray-600">Unauthorized (invalid token)</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm">404</span>
                                    <span class="text-sm text-gray-600">Resource not found</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm">422</span>
                                    <span class="text-sm text-gray-600">Invalid parameters</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm">500</span>
                                    <span class="text-sm text-gray-600">Server error</span>
                                </div>
                            </div>
                        </div>

                        <!-- Usage Example -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium mb-3">💻 JavaScript Usage Example</h4>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-javascript">// Kiosk API Client
const kioskAPI = {
  baseURL: '/api/kiosk',
  token: localStorage.getItem('kiosk_token'),
  
  async request(endpoint, options = {}) {
    const response = await fetch(`${this.baseURL}${endpoint}`, {
      headers: {
        'Authorization': `Bearer ${this.token}`,
        'Accept': 'application/json',
        ...options.headers
      },
      ...options
    });
    return await response.json();
  },
  
  // Get restaurants
  async getRestaurants(params = {}) {
    const query = new URLSearchParams(params).toString();
    return this.request(`/restaurants?${query}`);
  },
  
  // Get availability
  async getAvailability(slug, date = null) {
    const query = date ? `?date=${date}` : '';
    return this.request(`/availability/restaurant/${slug}${query}`);
  }
};

// Usage
kioskAPI.getRestaurants({ search: 'georgian' })
  .then(data => console.log(data));</code></pre>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-sm text-gray-600 mb-2">
                        📚 დეტალური ინფორმაციისთვის იხილეთ: 
                        <a href="{{ url('/docs/KIOSK_API_COMPLETE.md') }}" class="text-blue-600 hover:text-blue-800">KIOSK_API_COMPLETE.md</a>
                    </p>
                    <p class="text-xs text-gray-500">
                        ბოლო განახლება: 17 ივლისი, 2025 | API Version: v1.0
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Highlight active section in navigation
        const sections = document.querySelectorAll('.api-section');
        const navLinks = document.querySelectorAll('nav a[href^="#"]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('bg-gray-100', 'text-gray-900');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('bg-gray-100', 'text-gray-900');
                }
            });
        });
    </script>
</body>
</html>
