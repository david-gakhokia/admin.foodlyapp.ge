@extends('layouts.admin')

@section('title', 'Cuisine-ის დამატება - ' . $restaurant->name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus text-primary"></i>
            Cuisine-ის დამატება
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">რესტორნები</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.cuisines.index', $restaurant) }}">Cuisines</a></li>
                <li class="breadcrumb-item active">დამატება</li>
            </ol>
        </nav>
    </div>

    <!-- Restaurant Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                რესტორანი
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $restaurant->name }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
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
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-utensils"></i> Cuisine-ის დამატების ფორმა
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.restaurants.cuisines.store', $restaurant) }}" method="POST">
                        @csrf
                        
                        <!-- Cuisine Selection -->
                        <div class="form-group mb-3">
                            <label for="cuisine_id" class="form-label">
                                <strong>აირჩიეთ Cuisine *</strong>
                            </label>
                            <select name="cuisine_id" id="cuisine_id" class="form-control @error('cuisine_id') is-invalid @enderror" required>
                                <option value="">-- აირჩიეთ Cuisine --</option>
                                @foreach($availableCuisines as $cuisine)
                                    <option value="{{ $cuisine->id }}" 
                                            {{ old('cuisine_id', request('cuisine_id')) == $cuisine->id ? 'selected' : '' }}>
                                        {{ $cuisine->name }} (Rank: {{ $cuisine->rank }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cuisine_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                აირჩიეთ cuisine რომელიც გსურთ ამ რესტორნისთვის დაამატოთ.
                            </small>
                        </div>

                        <!-- Rank -->
                        <div class="form-group mb-3">
                            <label for="rank" class="form-label">
                                <strong>Rank (დალაგების რიგი)</strong>
                            </label>
                            <input type="number" 
                                   name="rank" 
                                   id="rank" 
                                   class="form-control @error('rank') is-invalid @enderror" 
                                   value="{{ old('rank', 0) }}"
                                   min="0"
                                   max="999">
                            @error('rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                რიცხვი დალაგების მიზნით. 0 = პირველი, 1 = მეორე, და ა.შ.
                            </small>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-4">
                            <label for="status" class="form-label">
                                <strong>სტატუსი *</strong>
                            </label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>
                                    აქტიური
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    არააქტიური
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                აქტიური cuisine-ები ჩანს public ვებსაიტზე.
                            </small>
                        </div>

                        <!-- Buttons -->
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('admin.restaurants.cuisines.index', $restaurant) }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> უკან დაბრუნება
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Cuisine-ის დამატება
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Available Cuisines Preview -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-list"></i> ხელმისაწვდომი Cuisines
                    </h6>
                </div>
                <div class="card-body">
                    @if($availableCuisines->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($availableCuisines->take(8) as $cuisine)
                                <div class="list-group-item px-0 cursor-pointer cuisine-select" 
                                     data-cuisine-id="{{ $cuisine->id }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $cuisine->name }}</strong>
                                            @if($cuisine->image)
                                                <br><img src="{{ $cuisine->image }}" alt="{{ $cuisine->name }}" style="width: 25px; height: 25px; object-fit: cover;" class="rounded">
                                            @endif
                                            <br><small class="text-muted">Rank: {{ $cuisine->rank }}</small>
                                        </div>
                                        <i class="fas fa-hand-pointer text-primary"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($availableCuisines->count() > 8)
                            <div class="text-center mt-3">
                                <small class="text-muted">და კიდევ {{ $availableCuisines->count() - 8 }} cuisines...</small>
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
// Cuisine selection helper
$('.cuisine-select').click(function() {
    const cuisineId = $(this).data('cuisine-id');
    $('#cuisine_id').val(cuisineId);
    
    // Visual feedback
    $('.cuisine-select').removeClass('bg-light');
    $(this).addClass('bg-light');
});

// Pre-select if cuisine_id in URL
$(document).ready(function() {
    const selectedCuisineId = $('#cuisine_id').val();
    if (selectedCuisineId) {
        $(`.cuisine-select[data-cuisine-id="${selectedCuisineId}"]`).addClass('bg-light');
    }
});
</script>
@endsection
