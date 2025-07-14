@extends('layouts.admin')

@section('title', 'Cuisine კავშირის რედაქტირება - ' . $restaurant->name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-warning"></i>
            Cuisine კავშირის რედაქტირება
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">რესტორნები</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.cuisines.index', $restaurant) }}">Cuisines</a></li>
                <li class="breadcrumb-item active">რედაქტირება</li>
            </ol>
        </nav>
    </div>

    <!-- Restaurant & Cuisine Info -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
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
        <div class="col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Cuisine
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cuisine->name }}</div>
                        </div>
                        <div class="col-auto">
                            @if($cuisine->image)
                                <img src="{{ $cuisine->image }}" alt="{{ $cuisine->name }}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded">
                            @else
                                <i class="fas fa-utensils fa-2x text-gray-300"></i>
                            @endif
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
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-edit"></i> კავშირის პარამეტრების რედაქტირება
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.restaurants.cuisines.update', [$restaurant, $cuisine]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Current Cuisine Info (Read-only) -->
                        <div class="form-group mb-3">
                            <label class="form-label">
                                <strong>Cuisine</strong>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $cuisine->name }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Cuisine-ის ცვლილება შეუძლებელია. თუ გჭირდებათ სხვა cuisine, წაშალეთ ეს და დაამატეთ ახალი.
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
                                   value="{{ old('rank', $pivotData->pivot->rank) }}"
                                   min="0"
                                   max="999">
                            @error('rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                რიცხვი დალაგების მიზნით. 0 = პირველი, 1 = მეორე, და ა.შ.
                                <br><strong>მიმდინარე მნიშვნელობა:</strong> {{ $pivotData->pivot->rank }}
                            </small>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-4">
                            <label for="status" class="form-label">
                                <strong>სტატუსი *</strong>
                            </label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $pivotData->pivot->status) === 'active' ? 'selected' : '' }}>
                                    აქტიური
                                </option>
                                <option value="inactive" {{ old('status', $pivotData->pivot->status) === 'inactive' ? 'selected' : '' }}>
                                    არააქტიური
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                აქტიური cuisine-ები ჩანს public ვებსაიტზე.
                                <br><strong>მიმდინარე სტატუსი:</strong> 
                                @if($pivotData->pivot->status === 'active')
                                    <span class="badge badge-success">აქტიური</span>
                                @else
                                    <span class="badge badge-secondary">არააქტიური</span>
                                @endif
                            </small>
                        </div>

                        <!-- Buttons -->
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('admin.restaurants.cuisines.index', $restaurant) }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> უკან დაბრუნება
                            </a>
                            <div>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> ცვლილებების შენახვა
                                </button>
                                <button type="button" class="btn btn-danger ml-2" onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i> წაშლა
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Hidden Delete Form -->
                    <form id="deleteForm" action="{{ route('admin.restaurants.cuisines.destroy', [$restaurant, $cuisine]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-info-circle"></i> კავშირის ინფორმაცია
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong>შექმნის თარიღი:</strong>
                        </div>
                        <div class="col-sm-6">
                            {{ $pivotData->pivot->created_at ? $pivotData->pivot->created_at->format('d/m/Y H:i') : 'უცნობი' }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong>განახლების თარიღი:</strong>
                        </div>
                        <div class="col-sm-6">
                            {{ $pivotData->pivot->updated_at ? $pivotData->pivot->updated_at->format('d/m/Y H:i') : 'არ განახლდა' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong>Cuisine ID:</strong>
                        </div>
                        <div class="col-sm-6">
                            {{ $cuisine->id }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong>Restaurant ID:</strong>
                        </div>
                        <div class="col-sm-6">
                            {{ $restaurant->id }}
                        </div>
                    </div>

                    <hr>

                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i>
                        <strong>რჩევა:</strong> Rank-ის ცვლილება გავლენას ახდენს cuisine-ების დალაგების რიგზე რესტორნის გვერდზე.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmDelete() {
    if (confirm('დარწმუნებული ხართ, რომ გსურთ ამ cuisine-ის წაშლა ამ რესტორნიდან?\n\nეს მოქმედება შეუქცევადია.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection
