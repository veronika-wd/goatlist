<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">Новая категория</h1>
    <div class="card max-w-lg">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <x-input label="Название категории" name="name" required />
            <div class="flex gap-3 pt-4">
                <x-btn type="submit">Создать</x-btn>
                <a href="{{ route('admin.categories.index') }}"><x-btn variant="outline">Отмена</x-btn></a>
            </div>
        </form>
    </div>
</x-layouts.app>
