<div class="p-6">
    <table class="w-full text-sm text-left text-gray-700 border rounded-lg">
        <thead class="bg-gray-100 text-xs uppercase">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Slug</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuisines as $cuisine)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $cuisine->id }}</td>
                    <td class="px-4 py-2">
                        @if ($cuisine->image)
                            <img src="{{ $cuisine->image }}" class="h-10 w-10 rounded-full object-cover" alt="Image">
                        @else
                            <span class="text-gray-400 italic">No image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $cuisine->slug }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-white text-xs {{ $cuisine->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($cuisine->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.cuisines.edit', $cuisine->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
