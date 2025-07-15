<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foodly API Documentation</title>
    
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
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    
    <!-- Header -->
    <div class="sticky-nav bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">🍽️ Foodly API</h1>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">v1.0</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Base URL: <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ config('app.url') }}/api</code></span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex gap-8">
            
            <!-- Sidebar Navigation -->
            <div class="w-64 flex-shrink-0">
                <nav class="sticky top-24 space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">API Endpoints</h3>
                    
                    <div class="space-y-1">
                        <a href="#authentication" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🔐 Authentication</a>
                        <a href="#webapp" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🌐 WebApp API</a>
                        <a href="#kiosk" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏪 Kiosk API</a>
                        <a href="#admin" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🛠️ Admin API</a>
                        <a href="#booking" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📅 Booking API</a>
                        <a href="#phone" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📱 Phone Verification</a>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="flex-1 min-w-0">
                
                <!-- Introduction -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Foodly API Documentation</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Foodly API არის RESTful API რომელიც უზრუნველყოფს რესტორნების, კულინარიული სივრცეების, და ჯავშნების მართვას.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="font-semibold text-blue-900 mb-2">🌐 WebApp API</h3>
                            <p class="text-sm text-blue-700">საჯარო API მომხმარებლებისთვის</p>
                        </div>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <h3 class="font-semibold text-purple-900 mb-2">🏪 Kiosk API</h3>
                            <p class="text-sm text-purple-700">კიოსკების და ტერმინალებისთვის</p>
                        </div>
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                            <h3 class="font-semibold text-orange-900 mb-2">🛠️ Admin API</h3>
                            <p class="text-sm text-orange-700">ადმინისტრირებისთვის</p>
                        </div>
                    </div>
                </div>

                <!-- Authentication Section -->
                <section id="authentication" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🔐 Authentication</h2>
                    
                    <div class="space-y-6">
                        <!-- Login -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">User Login</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/login</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Request Body:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "email": "user@example.com",
  "password": "password123"
}</code></pre>
                            </div>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Response:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com"
  },
  "token": "1|laravel_sanctum_token"
}</code></pre>
                            </div>
                        </div>

                        <!-- Logout -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">User Logout</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/logout</code>
                            <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication token</p>
                        </div>
                    </div>
                </section>

                <!-- Phone Verification Section -->
                <section id="phone" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📱 Phone Verification</h2>
                    
                    <div class="space-y-6">
                        <!-- Send OTP -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Send OTP</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/phone/send-otp</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Request Body:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "phone": "+995555123456"
}</code></pre>
                            </div>
                        </div>

                        <!-- Verify OTP -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold">Verify OTP</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/phone/verify-otp</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Request Body:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "phone": "+995555123456",
  "otp": "123456"
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- WebApp API Section -->
                <section id="webapp" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🌐 WebApp API</h2>
                    <p class="text-gray-600 mb-6">საჯარო API endpoints მომხმარებლების აპლიკაციებისთვის</p>
                    
                    <div class="space-y-8">
                        <!-- Restaurants -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏡 Restaurants</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Restaurants</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurant by Slug</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants/{slug}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurant Places</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants/{slug}/places</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurant Tables</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants/{slug}/tables</code>
                                </div>
                            </div>
                        </div>

                        <!-- Spaces -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏢 Spaces</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Spaces</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/spaces</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Space by Slug</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/spaces/{slug}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by Space</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/spaces/{slug}/restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Cuisines -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🍽️ Cuisines</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Cuisines</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cuisines</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by Cuisine</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cuisines/{slug}/restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Cities -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏙️ Cities</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Cities</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cities</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by City</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cities/{slug}/restaurants</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Kiosk API Section -->
                <section id="kiosk" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🏪 Kiosk API</h2>
                    <p class="text-gray-600 mb-6">კიოსკების და ტერმინალებისთვის განკუთვნილი API endpoints</p>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <span class="text-yellow-600 mr-2">⚠️</span>
                            <span class="text-yellow-800 font-medium">Authentication Required</span>
                        </div>
                        <p class="text-yellow-700 text-sm mt-1">ყველა kiosk endpoint საჭიროებს authentication token-ს (გარდა login-ისა)</p>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Kiosk Authentication -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🔐 Kiosk Authentication</h3>
                            <div class="space-y-4">
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
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Kiosk Heartbeat</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/heartbeat</code>
                                    <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication | აღნიშნავს რომ კიოსკი მუშაობს</p>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Kiosks Status</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/status</code>
                                    <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication</p>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Kiosk Configuration</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/config</code>
                                    <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Restaurants -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏡 Kiosk Restaurants</h3>
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
                                        <span class="font-medium">Get Specific Place</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/place/{place}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Tables in Place</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/place/{place}/tables</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Restaurant Tables</span>
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
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Table in Specific Place</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/place/{place}/table/{table}</code>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Menu System -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🍽️ Kiosk Menu System</h3>
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
                                    <p class="text-sm text-gray-600 mt-2">Returns hierarchical menu with categories and items</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Spaces -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏢 Kiosk Spaces</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Spaces</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces</code>
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
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Top 10 Restaurants by Space</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spaces/{slug}/top-10-restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Cuisines -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🍽️ Kiosk Cuisines</h3>
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
                                        <span class="font-medium">Get Cuisine by Slug</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines/{slug}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by Cuisine</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines/{slug}/restaurants</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Top 10 Restaurants by Cuisine</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/cuisines/{slug}/top-10-restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Dishes -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🥘 Kiosk Dishes</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get All Dishes</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Dish by Slug</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by Dish</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}/restaurants</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Top 10 Restaurants by Dish</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/dishes/{slug}/top-10-restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Spots -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">📍 Kiosk Spots</h3>
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
                                        <span class="font-medium">Get Spot by Slug</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spots/{slug}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Restaurants by Spot</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spots/{slug}/restaurants</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Top 10 Restaurants by Spot</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/spots/{slug}/top-10-restaurants</code>
                                </div>
                            </div>
                        </div>

                        <!-- Kiosk Categories -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🗂️ Kiosk Categories</h3>
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
                        </div>

                        <!-- Example Response -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">📋 Kiosk Response Example</h3>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-medium mb-2">Restaurant List Response:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "data": [
    {
      "id": 1,
      "name": "Georgian House",
      "slug": "georgian-house",
      "description": "Traditional Georgian cuisine in the heart of Tbilisi",
      "image": "https://example.com/images/restaurant.jpg",
      "rating": 4.8,
      "address": "Rustaveli Avenue 12",
      "phone": "+995555123456",
      "status": "active"
    }
  ],
  "meta": {
    "per_page": 20,
    "current_page": 1,
    "last_page": 5,
    "total": 87
  }
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Admin API Section -->
                <section id="admin" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🛠️ Admin API</h2>
                    <p class="text-gray-600 mb-6">ადმინისტრატორებისთვის განკუთვნილი CRUD operations</p>
                    
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <span class="text-red-600 mr-2">🔐</span>
                            <span class="text-red-800 font-medium">Admin Access Required</span>
                        </div>
                        <p class="text-red-700 text-sm mt-1">ეს endpoints საჭიროებს ადმინისტრატორის უფლებებს</p>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Spaces Management -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏢 Spaces Management</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Create Space</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/software/spaces</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Update Space</span>
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">PUT</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/software/spaces/{id}</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Delete Space</span>
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">DELETE</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/software/spaces/{id}</code>
                                </div>
                            </div>
                        </div>

                        <!-- Places Management -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">📍 Places Management</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Create Place</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/software/places</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Update Place</span>
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">PUT</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/software/places/{id}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Booking API Section -->
                <section id="booking" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📅 Booking API</h2>
                    <p class="text-gray-600 mb-6">ჯავშნების და რეზერვაციების მართვისთვის</p>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <span class="text-blue-600 mr-2">⚡</span>
                            <span class="text-blue-800 font-medium">Rate Limited</span>
                        </div>
                        <p class="text-blue-700 text-sm mt-1">ეს endpoints შეზღუდულია 60 მოთხოვნამდე წუთში</p>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Restaurant Reservations -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">🏡 Restaurant Reservations</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Reserve Restaurant</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/booking/restaurant/{slug}/reserve</code>
                                    
                                    <div class="mt-4">
                                        <h4 class="font-medium mb-2">Request Body:</h4>
                                        <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "customer_name": "John Doe",
  "customer_phone": "+995555123456",
  "customer_email": "john@example.com",
  "guests_count": 4,
  "reservation_date": "2025-07-20",
  "reservation_time": "19:00",
  "special_requests": "Window table please"
}</code></pre>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Reserve Table</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/booking/restaurant/{restaurant_slug}/table/{table_slug}/reserve</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Get Available Slots</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/booking/{type}/{id}/available-slots</code>
                                </div>
                            </div>
                        </div>

                        <!-- OTP & SMS -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">📱 OTP & SMS Verification</h3>
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Verify OTP for Booking</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/booking/restaurant/{slug}/verify-otp</code>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium">Send SMS for Booking</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                                    </div>
                                    <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/booking/restaurant/{slug}/send-sms</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Response Examples -->
                <section class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📋 Common Response Examples</h2>
                    
                    <div class="space-y-6">
                        <!-- Success Response -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-green-700">✅ Success Response</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "success": true,
  "message": "Restaurant fetched successfully",
  "data": {
    "id": 1,
    "name": "Georgian House",
    "slug": "georgian-house",
    "description": "Traditional Georgian cuisine",
    "address": "Rustaveli Avenue 12, Tbilisi",
    "phone": "+995555123456",
    "email": "info@georgianhouse.ge",
    "rating": 4.8,
    "created_at": "2025-01-01T00:00:00.000000Z"
  }
}</code></pre>
                        </div>

                        <!-- Error Response -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-red-700">❌ Error Response</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "success": false,
  "message": "Restaurant not found",
  "error": {
    "code": 404,
    "details": "The requested restaurant does not exist"
  }
}</code></pre>
                        </div>

                        <!-- Validation Error -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-yellow-700">⚠️ Validation Error</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."],
    "phone": ["The phone field must be a valid phone number."]
  }
}</code></pre>
                        </div>
                    </div>
                </section>

                <!-- Status Codes -->
                <section class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🔢 HTTP Status Codes</h2>
                    
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Meaning</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Description</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">200</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">OK</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">The request was successful</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">201</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Created</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Resource was successfully created</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-600">400</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Bad Request</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Invalid request parameters</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">401</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Unauthorized</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Authentication required</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">403</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Forbidden</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Insufficient permissions</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">404</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Not Found</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Resource not found</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">422</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Unprocessable Entity</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Validation errors</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">429</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Too Many Requests</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Rate limit exceeded</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">500</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Internal Server Error</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Server error occurred</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-500">
                <p>&copy; {{ date('Y') }} Foodly API Documentation. Built with Laravel {{ app()->version() }}</p>
                <p class="mt-2 text-sm">Last updated: {{ date('F j, Y') }}</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Highlight active section in navigation
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.api-section');
            const navLinks = document.querySelectorAll('nav a');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('bg-blue-100', 'text-blue-700');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('bg-blue-100', 'text-blue-700');
                }
            });
        });
    </script>
</body>
</html>
