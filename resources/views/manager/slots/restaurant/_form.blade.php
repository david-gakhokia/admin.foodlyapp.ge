@php
    $editing = isset($slot);
@endphp

<form method="POST" action="{{ $editing ? route('manager.slots.restaurant.slots.update', [$restaurantId, $slot->id]) : route('manager.slots.restaurant.slots.store', $restaurantId) }}">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Day of Week</label>
        <select name="day_of_week" class="form-select" required>
            <option value="">Select a day</option>
            @php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            @endphp
            @foreach($days as $day)
                <option value="{{ $day }}" {{ old('day_of_week', $slot->day_of_week ?? '') == $day ? 'selected' : '' }}>
                    {{ $day }}
                </option>
            @endforeach
        </select>
        @error('day_of_week')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Start Time</label>
        <input type="time" name="time_from" value="{{ old('time_from', $slot->time_from ?? '') }}" class="form-control" required>
        @error('time_from')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">End Time</label>
        <input type="time" name="time_to" value="{{ old('time_to', $slot->time_to ?? '') }}" class="form-control" required>
        @error('time_to')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Slot Interval (minutes)</label>
        <input type="number" name="slot_interval_minutes" value="{{ old('slot_interval_minutes', $slot->slot_interval_minutes ?? 30) }}" class="form-control" required min="15" max="120" step="15">
        @error('slot_interval_minutes')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="available" class="form-select" required>
            <option value="1" {{ old('available', $slot->available ?? 1) == 1 ? 'selected' : '' }}>Available</option>
            <option value="0" {{ old('available', $slot->available ?? 1) == 0 ? 'selected' : '' }}>Not Available</option>
        </select>
        @error('available')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('manager.slots.restaurant.slots.index', $restaurantId) }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
            {{ $editing ? 'Update Time Slot' : 'Create Time Slot' }}
        </button>
    </div>
</form>