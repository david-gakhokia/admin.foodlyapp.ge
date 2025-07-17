<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Documentation - Foodly</title>
    
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
                    <div class="flex space-x-2">
                        <a href="{{ route('docs.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← Back to Docs</a>
                        <a href="{{ route('docs.kiosk') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Kiosk API</a>
                        <a href="{{ route('docs.webapp') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">WebApp API</a>
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
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">API Documentation</h3>
                    
                    <div class="space-y-1">
                        <a href="#overview" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📋 Overview</a>
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
                
                <!-- Overview -->
                <section id="overview" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">🍽️ Foodly API Documentation</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Foodly API არის RESTful API რომელიც უზრუნველყოფს რესტორნების, კულინარიული სივრცეების, და ჯავშნების მართვას.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🌐</span>
                                <h3 class="font-semibold text-blue-900">WebApp API</h3>
                            </div>
                            <p class="text-sm text-blue-700">საჯარო API მომხმარებლების აპლიკაციებისთვის</p>
                            <a href="{{ route('docs.webapp') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 inline-block">View WebApp Docs →</a>
                        </div>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🏪</span>
                                <h3 class="font-semibold text-green-900">Kiosk API</h3>
                            </div>
                            <p class="text-sm text-green-700">კიოსკებისა და ტერმინალების API</p>
                            <a href="{{ route('docs.kiosk') }}" class="text-green-600 hover:text-green-800 text-sm font-medium mt-2 inline-block">View Kiosk Docs →</a>
                        </div>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🛠️</span>
                                <h3 class="font-semibold text-purple-900">Admin API</h3>
                            </div>
                            <p class="text-sm text-purple-700">ადმინისტრაციული CRUD operations</p>
                            <span class="text-purple-600 text-sm mt-2 inline-block">Coming Soon</span>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <span class="text-yellow-600 mr-2">📋</span>
                            <span class="text-yellow-800 font-medium">API Versions</span>
                        </div>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p><strong>Current Version:</strong> v1.0</p>
                            <p><strong>Base URL:</strong> <code class="bg-yellow-100 px-2 py-1 rounded">{{ config('app.url') }}/api</code></p>
                            <p><strong>Format:</strong> JSON</p>
                            <p><strong>Charset:</strong> UTF-8</p>
                        </div>
                    </div>
                </section>

                <!-- Quick Links Section -->
                <section class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🚀 Quick Start</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- WebApp API Quick Links -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">🌐 WebApp API</h3>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('docs.webapp') }}#restaurants" class="text-blue-600 hover:text-blue-800">🏡 Get Restaurants</a></li>
                                <li><a href="{{ route('docs.webapp') }}#spaces" class="text-blue-600 hover:text-blue-800">🏢 Get Spaces</a></li>
                                <li><a href="{{ route('docs.webapp') }}#cuisines" class="text-blue-600 hover:text-blue-800">🍽️ Get Cuisines</a></li>
                                <li><a href="{{ route('docs.webapp') }}#cities" class="text-blue-600 hover:text-blue-800">🏙️ Get Cities</a></li>
                            </ul>
                        </div>

                        <!-- Kiosk API Quick Links -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">🏪 Kiosk API</h3>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('docs.kiosk') }}#authentication" class="text-green-600 hover:text-green-800">🔐 Authentication</a></li>
                                <li><a href="{{ route('docs.kiosk') }}#restaurants" class="text-green-600 hover:text-green-800">🏡 Restaurants</a></li>
                                <li><a href="{{ route('docs.kiosk') }}#menu" class="text-green-600 hover:text-green-800">🍽️ Menu System</a></li>
                                <li>
                                    <span class="text-orange-600 text-xs font-medium bg-orange-100 px-2 py-1 rounded mr-2">NEW</span>
                                    <a href="{{ route('docs.kiosk') }}#availability" class="text-orange-600 hover:text-orange-800 font-medium">🕐 Availability System</a>
                                </li>
                                <li class="ml-4">
                                    <span class="text-xs text-gray-500">•</span>
                                    <a href="{{ route('docs.kiosk') }}#availability" class="text-green-600 hover:text-green-800 text-xs">Tables Overview</a>
                                </li>
                                <li class="ml-4">
                                    <span class="text-xs text-gray-500">•</span>
                                    <a href="{{ route('docs.kiosk') }}#availability" class="text-green-600 hover:text-green-800 text-xs">Available Times</a>
                                </li>
                                <li class="ml-4">
                                    <span class="text-xs text-gray-500">•</span>
                                    <a href="{{ route('docs.kiosk') }}#availability" class="text-green-600 hover:text-green-800 text-xs">Tables by Time</a>
                                </li>
                                <li class="ml-4">
                                    <span class="text-xs text-gray-500">•</span>
                                    <a href="{{ route('docs.kiosk') }}#availability" class="text-orange-600 hover:text-orange-800 text-xs">Place-Specific Search</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Common Authentication Section -->
                <section id="authentication" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🔐 Authentication</h2>
                    
                    <div class="space-y-6">
                        <!-- User Authentication -->
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

                        <!-- Phone Verification -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Phone Verification</span>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/phone/send-otp</code>
                            <p class="text-sm text-gray-600 mt-2">📱 SMS OTP verification system</p>
                        </div>
                    </div>
                </section>

                <!-- WebApp API Section -->
                <section id="webapp" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🌐 WebApp API</h2>
                    <p class="text-gray-600 mb-6">Public API for web applications and mobile apps</p>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">🌍 Public access | Get all restaurants with pagination</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Spaces</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/spaces</code>
                            <p class="text-sm text-gray-600 mt-2">🌍 Public access | Get all culinary spaces</p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Cuisines</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cuisines</code>
                            <p class="text-sm text-gray-600 mt-2">🌍 Public access | Get all cuisine types</p>
                        </div>
                    </div>
                </section>

                <!-- Kiosk API Section -->
                <section id="kiosk" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🏪 Kiosk API</h2>
                    <p class="text-gray-600 mb-6">Specialized API for kiosk terminals and touch screens</p>
                    
                    <div class="space-y-4">
                        <!-- Authentication -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Kiosk Login</span>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">POST</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/login</code>
                            <p class="text-sm text-gray-600 mt-2">🔐 Kiosk authentication with identifier and secret</p>
                        </div>

                        <!-- Restaurants -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants</code>
                            <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication | Extended restaurant data</p>
                        </div>

                        <!-- Availability - NEW SECTION -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-green-900 mb-3">🕐 Availability System</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-sm">Tables Overview</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">GET</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono block">/api/kiosk/availability/restaurant/{slug}/tables-overview</code>
                                <p class="text-xs text-green-700">🎯 For initial page load - shows all tables with status</p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-sm">Available Times</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">GET</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono block">/api/kiosk/availability/restaurant/{slug}/times</code>
                                <p class="text-xs text-green-700">🎯 For date selection - shows all available times</p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-sm">Tables by Time</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">GET</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono block">/api/kiosk/availability/restaurant/{slug}/tables-by-time</code>
                                <p class="text-xs text-green-700">🎯 For time selection - shows available tables for specific time</p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-sm">Place Specific Tables</span>
                                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded">NEW</span>
                                </div>
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono block">/api/kiosk/availability/restaurant/{slug}/{place}/tables-by-time</code>
                                <p class="text-xs text-green-700">🎯 For place-specific search - shows tables for specific place and time</p>
                            </div>
                        </div>

                        <!-- Menu System -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Menu System</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/kiosk/restaurants/{slug}/menu</code>
                            <p class="text-sm text-gray-600 mt-2">🔒 Requires authentication | Full menu structure</p>
                        </div>
                    </div>
                </section>

                <!-- API Comparison Table -->
                <section class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📊 API Comparison</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feature</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">WebApp API</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kiosk API</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin API</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Authentication</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Optional</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Required</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Required + Admin Role</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rate Limiting</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">60/min</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">120/min</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Unlimited</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Data Access</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Public Data</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Extended Data</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Full Access + CRUD</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Availability</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">❌</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">✅ Real-time</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">✅ Full Management</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Booking</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">❌</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">✅ Create</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">✅ Full CRUD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Status Codes -->
                <section class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📋 HTTP Status Codes</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-green-700 mb-3">Success Codes</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center p-2 bg-green-50 rounded">
                                    <code class="font-mono text-sm">200</code>
                                    <span class="text-sm text-green-700">OK - Success</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-green-50 rounded">
                                    <code class="font-mono text-sm">201</code>
                                    <span class="text-sm text-green-700">Created</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-green-50 rounded">
                                    <code class="font-mono text-sm">204</code>
                                    <span class="text-sm text-green-700">No Content</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-red-700 mb-3">Error Codes</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center p-2 bg-red-50 rounded">
                                    <code class="font-mono text-sm">400</code>
                                    <span class="text-sm text-red-700">Bad Request</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-red-50 rounded">
                                    <code class="font-mono text-sm">401</code>
                                    <span class="text-sm text-red-700">Unauthorized</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-red-50 rounded">
                                    <code class="font-mono text-sm">404</code>
                                    <span class="text-sm text-red-700">Not Found</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-red-50 rounded">
                                    <code class="font-mono text-sm">422</code>
                                    <span class="text-sm text-red-700">Validation Error</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-red-50 rounded">
                                    <code class="font-mono text-sm">500</code>
                                    <span class="text-sm text-red-700">Server Error</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-sm text-gray-600 mb-2">
                        📚 დეტალური ინფორმაციისთვის იხილეთ specific API documentation:
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('docs.webapp') }}" class="text-blue-600 hover:text-blue-800 font-medium">WebApp API Docs</a>
                        <span class="text-gray-400">|</span>
                        <a href="{{ route('docs.kiosk') }}" class="text-green-600 hover:text-green-800 font-medium">Kiosk API Docs</a>
                    </div>
                    <p class="text-xs text-gray-500 mt-4">
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
