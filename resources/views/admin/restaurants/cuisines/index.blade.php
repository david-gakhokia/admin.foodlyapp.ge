@extends('layouts.admin')

@section('title', 'რესტორნის Cuisines - ' . $restaurant->name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-utensils text-primary"></i>
            რესტორნის Cuisines მენეჯმენტი
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">რესტორნები</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a></li>
                <li class="breadcrumb-item active">Cuisines</li>
            </ol>
        </nav>
    </div>

    <!-- Restaurant Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                რესტორანი
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $restaurant->name }}</div>
                            <div class="text-sm text-gray-600">{{ $restaurant->address ?? 'მისამართი არ არის მითითებული' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- მიმაგრებული Cuisines -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-link"></i> მიმაგრებული Cuisines ({{ $restaurantCuisines->count() }})
                    </h6>
                    <a href="{{ route('admin.restaurants.cuisines.create', $restaurant) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> ახალი Cuisine-ის დამატება
                    </a>
                </div>
                <div class="card-body">
                    @if($restaurantCuisines->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cuisine</th>
                                        <th>Rank</th>
                                        <th>Status</th>
                                        <th>დამატების თარიღი</th>
                                        <th>ქმედებები</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($restaurantCuisines as $cuisine)
                                        <tr>
                                            <td>{{ $cuisine->id }}</td>
                                            <td>
                                                <strong>{{ $cuisine->name }}</strong>
                                                @if($cuisine->image)
                                                    <br><img src="{{ $cuisine->image }}" alt="{{ $cuisine->name }}" style="width: 30px; height: 30px; object-fit: cover;" class="rounded">
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $cuisine->pivot->rank }}</span>
                                            </td>
                                            <td>
                                                @if($cuisine->pivot->status === 'active')
                                                    <span class="badge badge-success">აქტიური</span>
                                                @else
                                                    <span class="badge badge-secondary">არააქტიური</span>
                                                @endif
                                            </td>
                                            <td>{{ $cuisine->pivot->created_at ? $cuisine->pivot->created_at->format('d/m/Y H:i') : '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.restaurants.cuisines.edit', [$restaurant, $cuisine]) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.restaurants.cuisines.destroy', [$restaurant, $cuisine]) }}" 
                                                          method="POST" 
                                                          style="display: inline-block;" 
                                                          onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ cuisine-ის წაშლა?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-utensils fa-3x text-gray-300 mb-3"></i>
                            <p class="text-gray-500">ამ რესტორანს არ აქვს მიმაგრებული Cuisines.</p>
                            <a href="{{ route('admin.restaurants.cuisines.create', $restaurant) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> პირველი Cuisine-ის დამატება
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ხელმისაწვდომი Cuisines -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-list"></i> ხელმისაწვდომი Cuisines ({{ $availableCuisines->count() }})
                    </h6>
                </div>
                <div class="card-body">
                    @if($availableCuisines->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($availableCuisines->take(10) as $cuisine)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <strong>{{ $cuisine->name }}</strong>
                                        <br><small class="text-muted">Rank: {{ $cuisine->rank }}</small>
                                    </div>
                                    <a href="{{ route('admin.restaurants.cuisines.create', $restaurant) }}?cuisine_id={{ $cuisine->id }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @if($availableCuisines->count() > 10)
                            <div class="text-center mt-3">
                                <small class="text-muted">და კიდევ {{ $availableCuisines->count() - 10 }} cuisines...</small>
                            </div>
                        @endif
                    @else
                        <p class="text-muted text-center">
                            <i class="fas fa-check-circle text-success"></i><br>
                            ყველა cuisine უკვე დამატებულია!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Auto-hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);
</script>
@endsection
