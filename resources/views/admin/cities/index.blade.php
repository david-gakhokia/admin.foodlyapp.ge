<x-layouts.app title="Cities Management">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Cities</h1>
            <a href="{{ route('admin.cities.create') }}"
               class="bg-gradient-to-r from-purple-600 to-violet-600 text-white px-6 py-3 rounded-xl shadow-lg font-medium hover:from-purple-700 hover:to-violet-700 transition-all duration-200">
                + Add City
            </a>
        </div>

        <form method="GET" class="mb-6 flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or slug..."
                   class="rounded-xl border-gray-300 px-4 py-2 w-64 focus:border-purple-500 focus:ring-2 focus:ring-purple-500">
            <select name="status" class="rounded-xl border-gray-300 px-4 py-2 focus:border-purple-500 focus:ring-2 focus:ring-purple-500">
                <option value="">All Statuses</option>
                @foreach(\App\Models\City::getStatuses() as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-xl font-medium hover:bg-purple-700 transition-all">Filter</button>
        </form>

        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cities as $city)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $city->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $city->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $city->slug }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded-xl text-xs font-semibold"
                                      style="background: {{ $city->status_color }}; color: white;">
                                    {{ $city->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $city->rank }}</td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.cities.show', $city) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium">View</a>
                                <a href="{{ route('admin.cities.edit', $city) }}"
                                   class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                                <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No cities found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $cities->links() }}
        </div>
    </div>
</x-layouts.app>