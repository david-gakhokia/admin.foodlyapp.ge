@extends('manager.layout')

@section('title', 'Create New Time Slot')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create New Time Slot for {{ $table->name }}</h4>
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
            
            @include('manager.slots.table._form', ['tableId' => $table->id])
        </div>
    </div>
@endsection
