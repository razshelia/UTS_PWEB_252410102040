@props(['kejutan'])

{{-- Dipicu oleh resources/js/kejutan.js setelah event tugas:selesai --}}
<dialog data-kejutan data-lencana="{{ $kejutan['lencana'] }}" aria-labelledby="judul-kejutan"
    class="m-auto w-[min(92vw,26rem)] max-w-none overflow-visible bg-transparent p-0 text-ink">
    <div class="relative rounded-3xl border-8 border-double border-berry bg-gradient-to-b from-cream to-blush shadow-2xl">
        <x-stiker nama="kilau-kuning" class="absolute -left-4 -top-5 z-10 w-12 animate-kelip" />
        <x-stiker nama="kilau-pink" class="absolute -right-3 -top-4 z-10 w-10 animate-kelip" />
        <x-stiker nama="pita-pink" class="absolute -bottom-6 -right-5 z-10 w-20 rotate-12" />

        <div class="max-h-[86dvh] overflow-y-auto p-5 text-center">
            <img src="{{ asset('assets/img/orby-kagum.webp') }}" alt="Orby bermata bintang memegang bintang besar" width="450" height="534"
                class="mx-auto h-28 w-auto animate-napas [@media(min-height:720px)]:h-40">

            <h2 id="judul-kejutan" class="judul-stiker mt-2 font-display text-3xl uppercase [@media(min-height:720px)]:text-4xl">Kejutan!</h2>
            <p class="mt-1 text-xl">Semua aktivitas hari ini selesai. Orby menyiapkan hadiah untukmu.</p>

            <div class="mt-4 rotate-1 rounded-2xl border-4 border-dashed border-bubble bg-white/80 p-4 text-left">
                <p class="font-display text-sm uppercase text-berry">{{ $kejutan['kategori'] }}</p>
                <h3 class="font-display text-2xl uppercase leading-tight">{{ $kejutan['judul'] }}</h3>
                <p class="mt-2 text-xl">{{ $kejutan['fakta'] }}</p>
                <p class="mt-2 text-xl italic text-berry">{{ $kejutan['pesan'] }}</p>
            </div>

            <p class="mt-4 inline-block rounded-full bg-berry px-5 py-1 text-xl text-white">
                <span aria-hidden="true">🏅</span> Lencana baru: {{ $kejutan['lencana'] }}
            </p>

            <div class="mt-4 flex flex-wrap justify-center gap-3">
                <button type="button" data-tutup
                    class="rounded-full border-4 border-berry bg-berry px-6 py-1 text-xl text-white transition-transform hover:bg-ink active:scale-95">Terima kejutan</button>
                <button type="button" data-ke-profil
                    class="rounded-full border-4 border-berry bg-white px-6 py-1 text-xl text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">Lihat lencana</button>
            </div>
        </div>
    </div>
</dialog>

{{-- popover="manual" menempatkan kanvas di top layer yang sama dengan <dialog>,
     jadi konfeti tetap tampil di atas kartu kejutan --}}
<canvas data-konfeti popover="manual" aria-hidden="true"
    class="pointer-events-none inset-0 m-0 h-dvh max-h-none w-screen max-w-none overflow-hidden border-0 bg-transparent p-0"></canvas>