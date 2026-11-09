@props(['nama'])

<img src="{{ asset('assets/img/' . $nama . '.webp') }}" alt="" loading="lazy" draggable="false"
    {{ $attributes->merge(['class' => 'pointer-events-none select-none drop-shadow-sm']) }}>