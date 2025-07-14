@if ($src)
    <img src="{{ $src }}" class="h-10 w-10 rounded-full object-cover shadow" alt="Image" />
@else
    <span class="text-gray-400 italic">No image</span>
@endif
