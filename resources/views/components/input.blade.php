@props(['label', 'name', 'type' => 'text'])

@php
    $pesan = $errors->first($name);
    $idError = $name . '-error'; 
@endphp

<div class="flex flex-col gap-1">
    <label for="{{ $name }}" class="font-medium">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        @if ($type !== 'password') value="{{ old($name) }}" @endif
        @if ($pesan) aria-invalid="true" aria-describedby="{{ $idError }}" @endif
        {{ $attributes->merge(['class' => 'rounded-2xl border-4 border-bubble bg-white px-4 py-2 text-ink placeholder:text-bubble/60']) }}>
    @if ($pesan)
        <p id="{{ $idError }}" class="text-sm font-medium text-red-700" role="alert">{{ $pesan }}</p>
    @endif
</div>