<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebApp API Documentation - Foodly</title>
    
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
                    <h1 class="text-2xl font-bold text-gray-900">🌐 WebApp API</h1>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Public API</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Base URL: <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ config('app.url') }}/api/webapp</code></span>
                    <div class="flex space-x-2">
                        <a href="{{ route('docs.api') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← API Overview</a>
                        <a href="{{ route('docs.kiosk') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Kiosk API</a>
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
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">WebApp API</h3>
                    
                    <div class="space-y-1">
                        <a href="#overview" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">📋 Overview</a>
                        <a href="#restaurants" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏡 Restaurants</a>
                        <a href="#spaces" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏢 Spaces</a>
                        <a href="#cuisines" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🍽️ Cuisines</a>
                        <a href="#cities" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">🏙️ Cities</a>
                        <a href="#examples" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-md">💻 Examples</a>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="flex-1 min-w-0">
                
                <!-- Overview -->
                <section id="overview" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">🌐 WebApp API Documentation</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        WebApp API არის საჯარო API endpoints მომხმარებლების აპლიკაციებისთვის. 
                        ეს API არ საჭიროებს authentication-ს და უზრუნველყოფს წვდომას საბაზისო რესურსებზე.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">🚀</span>
                                <h3 class="font-semibold text-blue-900">No Authentication</h3>
                            </div>
                            <p class="text-sm text-blue-700">არ საჭიროებს API token-ს ან registration-ს</p>
                        </div>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-2">📊</span>
                                <h3 class="font-semibold text-green-900">Public Data</h3>
                            </div>
                            <p class="text-sm text-green-700">მხოლოდ საჯარო ინფორმაცია</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <span class="text-blue-600 mr-2">ℹ️</span>
                            <span class="text-blue-800 font-medium">Rate Limiting</span>
                        </div>
                        <p class="text-blue-700 text-sm mt-1">60 requests per minute</p>
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
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/restaurants</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Response Example:</h4>
                                <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-json">[
  {
    "id": 1,
    "name": "Georgian House",
    "slug": "georgian-house",
    "description": "Traditional Georgian cuisine",
    "image": "https://example.com/restaurant.jpg",
    "rating": 4.8,
    "address": "Rustaveli Avenue 12",
    "phone": "+995555123456",
    "status": "active"
  }
]</code></pre>
                            </div>
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
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cuisines</code>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium">Get Restaurants by Cuisine</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">GET</span>
                            </div>
                            <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">/api/webapp/cuisines/{slug}/restaurants</code>
                            
                            <div class="mt-4">
                                <h4 class="font-medium mb-2">Popular Cuisine Slugs:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">georgian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">italian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">asian</code>
                                    <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">european</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Cities Section -->
                <section id="cities" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">🏙️ Cities</h2>
                    
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
                </section>

                <!-- Examples Section -->
                <section id="examples" class="api-section bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">💻 Usage Examples</h2>
                    
                    <div class="space-y-6">
                        <!-- JavaScript Example -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">JavaScript (Fetch API)</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-javascript">// WebApp API Client
const webappAPI = {
  baseURL: '{{ config('app.url') }}/api/webapp',
  
  async request(endpoint) {
    const response = await fetch(`${this.baseURL}${endpoint}`, {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    });
    
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    return await response.json();
  },
  
  // Get all restaurants
  async getRestaurants() {
    return this.request('/restaurants');
  },
  
  // Get restaurant by slug
  async getRestaurant(slug) {
    return this.request(`/restaurants/${slug}`);
  },
  
  // Get restaurants by cuisine
  async getRestaurantsByCuisine(cuisineSlug) {
    return this.request(`/cuisines/${cuisineSlug}/restaurants`);
  },
  
  // Get all spaces
  async getSpaces() {
    return this.request('/spaces');
  }
};

// Usage examples
webappAPI.getRestaurants()
  .then(restaurants => {
    console.log('Restaurants:', restaurants);
  })
  .catch(error => {
    console.error('Error:', error);
  });

webappAPI.getRestaurantsByCuisine('georgian')
  .then(restaurants => {
    console.log('Georgian restaurants:', restaurants);
  });</code></pre>
                        </div>

                        <!-- cURL Examples -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">cURL Examples</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-bash"># Get all restaurants
curl -X GET "{{ config('app.url') }}/api/webapp/restaurants" \
  -H "Accept: application/json"

# Get specific restaurant
curl -X GET "{{ config('app.url') }}/api/webapp/restaurants/georgian-house" \
  -H "Accept: application/json"

# Get restaurants by cuisine
curl -X GET "{{ config('app.url') }}/api/webapp/cuisines/georgian/restaurants" \
  -H "Accept: application/json"

# Get all spaces
curl -X GET "{{ config('app.url') }}/api/webapp/spaces" \
  -H "Accept: application/json"

# Get restaurants by space
curl -X GET "{{ config('app.url') }}/api/webapp/spaces/shopping-mall/restaurants" \
  -H "Accept: application/json"</code></pre>
                        </div>

                        <!-- React Example -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">React Hook Example</h3>
                            <pre class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto"><code class="language-javascript">import { useState, useEffect } from 'react';

// Custom hook for WebApp API
function useWebAppAPI() {
  const baseURL = '{{ config('app.url') }}/api/webapp';
  
  const request = async (endpoint) => {
    const response = await fetch(`${baseURL}${endpoint}`);
    if (!response.ok) throw new Error('API request failed');
    return response.json();
  };
  
  return {
    getRestaurants: () => request('/restaurants'),
    getRestaurant: (slug) => request(`/restaurants/${slug}`),
    getSpaces: () => request('/spaces'),
    getCuisines: () => request('/cuisines'),
  };
}

// Component example
function RestaurantList() {
  const [restaurants, setRestaurants] = useState([]);
  const [loading, setLoading] = useState(true);
  const api = useWebAppAPI();
  
  useEffect(() => {
    api.getRestaurants()
      .then(setRestaurants)
      .catch(console.error)
      .finally(() => setLoading(false));
  }, []);
  
  if (loading) return <div>Loading...</div>;
  
  return (
    <div>
      {restaurants.map(restaurant => (
        <div key={restaurant.id}>{restaurant.name}</div>
      ))}
    </div>
  );
}</code></pre>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-sm text-gray-600 mb-2">
                        🚀 WebApp API არის უფასო და ღია გამოყენებისთვის
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('docs.api') }}" class="text-blue-600 hover:text-blue-800 font-medium">← Back to API Docs</a>
                        <span class="text-gray-400">|</span>
                        <a href="{{ route('docs.kiosk') }}" class="text-green-600 hover:text-green-800 font-medium">Kiosk API Docs →</a>
                    </div>
                    <p class="text-xs text-gray-500 mt-4">
                        ბოლო განახლება: 17 ივლისი, 2025 | WebApp API v1.0
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
