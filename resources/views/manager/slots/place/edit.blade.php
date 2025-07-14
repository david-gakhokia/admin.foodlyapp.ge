@extends('manager.layout')

@section('title', 'Edit Time Slot')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Time Slot for {{ $place->name }}</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @include('manager.slots.place._form', ['slot' => $slot, 'placeId' => $place->id])
        </div>
    </div>
@endsection
