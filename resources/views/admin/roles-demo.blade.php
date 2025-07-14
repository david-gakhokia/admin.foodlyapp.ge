<x-layouts.app>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">როლებზე დაფუძნებული წვდომა</h1>

        @role('admin')
            <div class="bg-green-100 border p-4 rounded mb-4">
                <strong>Admin:</strong> შენ ხარ ადმინისტრატორი.
            </div>
        @endrole

        @role('editor')
            <div class="bg-blue-100 border p-4 rounded mb-4">
                <strong>Editor:</strong> შეგიძლია შეასწორო კონტენტი.
            </div>
        @endrole

        @can('manage users')
            <div class="bg-yellow-100 border p-4 rounded mb-4">
                <strong>Permission:</strong> გაქვს უფლება მართო მომხმარებლები.
            </div>
        @endcan

        @cannot('manage users')
            <div class="bg-red-100 border p-4 rounded">
                შენ არ გაქვს მომხმარებელთა მართვის უფლება.
            </div>
        @endcannot
    </div>
</x-layouts.app>
