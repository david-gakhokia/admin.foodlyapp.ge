<x-layouts.app>
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Edit Permission</h1>
        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $permission->name) }}" class="mt-1 block w-full border-gray-300 rounded" required>
                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('admin.permissions.index') }}" class="px-4 py-2 bg-gray-300 rounded">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app>
