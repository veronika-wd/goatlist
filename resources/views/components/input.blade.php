@props(['label' => null, 'name', 'type' => 'text', 'value' => ''])
<div class="field mb-4">@if($label)<label for="{{ $name }}">{{ $label }}</label>@endif<input class="control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes }}>@error($name)<p style="color:var(--danger);font-size:12px;margin-top:5px">{{ $message }}</p>@enderror</div>
