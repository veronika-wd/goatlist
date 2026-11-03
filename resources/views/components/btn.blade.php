@props(['variant' => 'primary', 'size' => 'md'])
@php($classes = 'btn '.match($variant){'outline'=>'btn-outline','danger'=>'btn-danger',default=>'btn-primary'}.' '.($size==='sm'?'btn-sm':''))
<button {{ $attributes->merge(['class'=>$classes]) }} type="{{ $attributes->get('type','button') }}">{{ $slot }}</button>
