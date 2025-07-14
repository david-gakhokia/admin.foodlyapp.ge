<x-layouts.app title="Edit Spot">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
        
        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-3 text-sm mb-8">
            <a href="{{ route('admin.spots.index') }}" 
               class="text-gray-500 hover:text-purple-600 transition-colors duration-200">
                Spots
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('admin.spots.show', $spot) }}" 
               class="text-gray-500 hover:text-purple-600 transition-colors duration-200">
                {{ $spot->name ?? 'Spot #' . $spot->id }}
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-purple-600 font-medium">Edit</span>
        </nav>

        {{-- Header Section --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Edit Spot
                    </h1>
                    <p class="text-gray-600 mt-1">Update spot information and translations</p>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30">
            <form action="{{ route('admin.spots.update', $spot) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.spots.form', ['spot' => $spot])
            </form>
        </div>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 7000)"
             class="fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 max-w-md">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-medium">Please fix the following errors:</h4>
                    <ul class="text-sm mt-1 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
