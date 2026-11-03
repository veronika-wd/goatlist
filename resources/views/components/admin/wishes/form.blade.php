@props([
    'wish' => null,
    'categories' => collect(),
    'statuses' => collect(),
])

<form method="POST" action="{{ $wish ? route('admin.wishes.update', $wish) : route('admin.wishes.store') }}" enctype="multipart/form-data">
    @csrf
    @if($wish) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-6">
        <x-input label="Название" name="name" :value="$wish?->name" required />
        <x-input label="Цена" name="price" type="number" step="0.01" :value="$wish?->price" />

        <x-select label="Категория" name="category_id" :value="$wish?->category_id" :options="$categories->pluck('name', 'id')" required />
        <x-select label="Статус" name="status_id" :value="$wish?->status_id" :options="$statuses->pluck('name', 'id')" required />
    </div>

    <div class="mb-4 mt-2">
        <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Описание</label>
        <textarea name="description" rows="4" class="w-full px-3 py-2 bg-[var(--color-bg-surface)] border border-[var(--color-border)] text-[var(--color-text-main)] focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] outline-none transition-colors resize-y">{{ old('description', $wish?->description) }}</textarea>
        @error('description') <p class="mt-1 text-xs text-[var(--color-danger)]">{{ $message }}</p> @enderror
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <x-input label="Ссылка на товар" name="link" type="url" :value="$wish?->link" placeholder="https://..." />

        <div class="mb-4">
            <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Изображение</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-[var(--color-text-muted)] file:mr-4 file:py-2 file:px-4 file:border file:border-[var(--color-border)] file:bg-[var(--color-bg-surface)] file:text-[var(--color-text-main)] hover:file:bg-[var(--color-primary-light)] file:cursor-pointer file:transition-colors">
            @error('image') <p class="mt-1 text-xs text-[var(--color-danger)]">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="mb-6 flex items-center gap-2">
        <input type="checkbox" name="is_ready" id="is_ready" value="1" {{ old('is_ready', $wish?->is_ready) ? 'checked' : '' }} class="w-4 h-4 accent-[var(--color-primary)] border-[var(--color-border)] bg-[var(--color-bg-surface)]">
        <label for="is_ready" class="text-sm font-medium text-[var(--color-text-main)]">Желание исполнено / готово к покупке</label>
    </div>

    <div class="flex gap-3 pt-4 border-t border-[var(--color-border)]">
        <x-btn type="submit">{{ $wish ? 'Сохранить изменения' : 'Создать желание' }}</x-btn>
        <a href="{{ route('admin.wishes.index') }}"><x-btn variant="outline">Отмена</x-btn></a>
    </div>
</form>
