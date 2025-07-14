@extends('manager.layout')
@section('content')
    <div class="container">
        <h1 class="mb-4">Occupancy Management</h1>

        <div class="card">
            <div class="card-body">
                <h5>Select Restaurant</h5>
                <ul class="list-group">
                    @foreach ($restaurants as $restaurant)
                        <li class="list-group-item">
                            <a href="{{ route('manager.occupancy.show', $restaurant->id) }}">{{ $restaurant->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
