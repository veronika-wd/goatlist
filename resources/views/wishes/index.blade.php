<x-layouts.app>
    <section class="section-head"><div><div class="eyebrow">Твой личный список</div><h1 class="page-title">Список желаний<span style="color:var(--green)">.</span></h1><p class="page-subtitle">Всё, о чём мечтаешь, — в одном месте.</p></div><div class="text-sm" style="color:var(--muted)">{{ method_exists($wishes, 'total') ? $wishes->total() : $wishes->count() }} желаний</div></section>
    <form method="GET" action="{{ route('wishes.index') }}" class="filters">
        <div class="field"><label for="category_id">Категория</label><select class="control" id="category_id" name="category_id"><option value="">Все категории</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>@endforeach</select></div>
        <div class="field"><label for="status_id">Статус</label><select class="control" id="status_id" name="status_id"><option value="">Все статусы</option>@foreach($statuses as $status)<option value="{{ $status->id }}" @selected(request('status_id') == $status->id)>{{ $status->name }}</option>@endforeach</select></div>
        <div class="field"><label for="sort">Сортировка</label><select class="control" id="sort" name="sort"><option value="newest" @selected(request('sort','newest')==='newest')>Сначала новые</option><option value="price_asc" @selected(request('sort')==='price_asc')>Сначала дешевле</option><option value="price_desc" @selected(request('sort')==='price_desc')>Сначала дороже</option></select></div>
        <button class="btn btn-primary" type="submit">Показать</button><a class="btn btn-outline" href="{{ route('wishes.index') }}">Сбросить</a>
    </form>
    <div class="wish-grid">
        @forelse($wishes as $wish)
            <a href="{{ route('wishes.show',$wish) }}" class="wish-card">
                @if($wish->image)<img class="wish-image" src="{{ asset('storage/'.$wish->image) }}" alt="{{ $wish->name }}" loading="lazy">@else<div class="wish-placeholder">✳</div>@endif
                <div class="wish-card-body"><div class="wish-title-row"><h2 class="wish-title">{{ $wish->name }}</h2>@if($wish->price !== null)<span class="wish-price">{{ number_format($wish->price,2,',',' ') }} ₽</span>@endif</div>
                    @if($wish->description)<p class="wish-description">{{ $wish->description }}</p>@else<div style="height:18px"></div>@endif
                    <div class="tag-row">@if($wish->category)<span class="tag">{{ $wish->category->name }}</span>@endif @if($wish->status)<span class="tag tag-muted">{{ $wish->status->name }}</span>@endif @if($wish->is_ready)<span class="tag">Готово</span>@endif</div>
                </div>
            </a>
        @empty<div class="empty-state"><div class="empty-icon">✳</div><strong style="color:var(--text)">Пока ничего не найдено</strong><p>Попробуй изменить фильтры или загляни позже.</p></div>@endforelse
    </div>
    @if(method_exists($wishes,'links'))<div class="pagination">{{ $wishes->withQueryString()->links() }}</div>@endif
</x-layouts.app>
