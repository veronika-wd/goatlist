<x-layouts.app>
    <a href="{{ route('wishes.index') }}" class="back-link">← Вернуться ко всем желаниям</a>
    <article class="card wish-detail">
        <div>@if($wish->image)<img class="detail-image" src="{{ asset('storage/'.$wish->image) }}" alt="{{ $wish->name }}">@else<div class="detail-placeholder">✳</div>@endif</div>
        <div class="detail-content"><div class="tag-row">@if($wish->category)<span class="tag">{{ $wish->category->name }}</span>@endif @if($wish->status)<span class="tag tag-muted">{{ $wish->status->name }}</span>@endif @if($wish->is_ready)<span class="tag">Исполнено</span>@endif</div>
            <h1>{{ $wish->name }}</h1>@if($wish->price !== null)<div class="detail-price">{{ number_format($wish->price,2,',',' ') }} ₽</div>@endif
            @if($wish->description)<div class="detail-description">{{ $wish->description }}</div>@endif
            @if($wish->link)<a class="btn btn-primary" href="{{ $wish->link }}" target="_blank" rel="noopener noreferrer">Перейти к товару <span aria-hidden="true">↗</span></a>@endif
        </div>
    </article>
</x-layouts.app>
