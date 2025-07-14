@extends('manager.layout')


@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Slot</h4>
    </div>
    <div class="card-body">
        @include('manager.slots.restaurant._form', ['slot' => $slot, 'restaurantId' => $restaurantId])
    </div>
</div>
@endsection