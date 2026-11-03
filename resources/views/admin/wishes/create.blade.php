<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">Новое желание</h1>
    <div class="card">
        <x-admin.wishes.form :categories="$categories" :statuses="$statuses" />
    </div>
</x-layouts.app>
