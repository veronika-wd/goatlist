<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">Редактирование: {{ $wish->name }}</h1>
    <div class="card">
        <x-admin.wishes.form :wish="$wish" :categories="$categories" :statuses="$statuses" />
    </div>
</x-layouts.app>
