<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10">
      <h1 class="text-2xl font-bold mb-6">როლის რედაქტირება</h1>
  
      <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
  
        <div>
          <label class="block font-medium mb-1">Role Name</label>
          <input type="text" name="name" value="{{ old('name', $role->name) }}"
                 class="w-full border rounded px-3 py-2 @error('name') border-red-600 @enderror">
          @error('name')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
  
        <div>
          <label class="block font-medium mb-1">Permissions</label>
          <div class="grid grid-cols-2 gap-2">
            @foreach($permissions as $perm)
            <label class="flex items-center space-x-2">
              <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                     {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
              <span>{{ $perm->name }}</span>
            </label>
            @endforeach
          </div>
          @error('permissions')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
  
        <div class="pt-4">
          <button type="submit"
                  class="bg-green-600 text-white px-4 py-2 rounded">
            შესვლა
          </button>
          <a href="{{ route('admin.roles.index') }}"
             class="ml-4 text-gray-600 hover:underline">
            უკან
          </a>
        </div>
      </form>
    </div>
  </x-layouts.app>
  