<x-layouts.app>
    <h1 class="text-2xl font-bold mb-6">Редактирование категории</h1>
    <div class="card max-w-lg">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <x-input label="Название категории" name="name" :value="$category->name" required />
            <div class="flex gap-3 pt-4">
                <x-btn type="submit">Сохранить</x-btn>
                <a href="{{ route('admin.categories.index') }}"><x-btn variant="outline">Отмена</x-btn></a>
            </div>
        </form>
    </div>
</x-layouts.app>
