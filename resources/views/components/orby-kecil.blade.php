{{-- Orby kecil yang mengikuti kursor (diatur di resources/js/orby.js). Popover agar tetap tampil di atas surat. --}}
<div data-orby-kecil popover="manual" aria-hidden="true"
    class="pointer-events-none inset-auto left-0 top-0 m-0 overflow-visible border-0 bg-transparent p-0 opacity-0 transition-opacity duration-300">
    <p data-orby-kecil-bubble class="absolute -top-9 left-1/2 hidden -translate-x-1/2 whitespace-nowrap rounded-full border-2 border-berry bg-white px-3 text-lg shadow"></p>
    <img data-orby-kecil-img src="{{ asset('assets/img/orby-beret.webp') }}" alt="" draggable="false"
        class="h-16 w-auto select-none drop-shadow">
</div>

<button type="button" data-orby-ikut aria-pressed="true"
    class="fixed bottom-4 left-4 z-40 hidden rounded-full border-2 border-berry bg-cream px-4 text-lg text-berry shadow transition-transform active:scale-95 aria-pressed:bg-berry aria-pressed:text-white">
    Orby Mengikuti?
</button>