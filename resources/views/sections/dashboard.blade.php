<section id="dashboard" aria-labelledby="judul-dashboard" class="relative scroll-mt-20 overflow-hidden bg-polos">
    <x-stiker nama="kupu-ungu" class="absolute left-[5%] top-8 hidden w-20 -rotate-12 animate-kelip md:block" />
    <x-stiker nama="kilau-kuning" class="absolute right-[7%] top-6 w-12 animate-kelip" />
    <x-stiker nama="kupu-pink" class="absolute right-[3%] top-1/2 hidden w-16 rotate-12 md:block" />
    <x-stiker nama="bunga-pink" class="absolute bottom-6 left-[3%] hidden w-14 rotate-12 md:block" />
    <x-stiker nama="kilau-pink" class="absolute bottom-10 right-[10%] w-10 animate-kelip" />

    <div class="relative mx-auto max-w-6xl px-4 py-12">
        <h1 id="judul-dashboard" class="judul-stiker mx-auto max-w-3xl text-center font-display text-4xl uppercase leading-tight md:text-6xl">
        Selamat datang di Loreberry, <span data-nama>{{ $username }}</span>!
        </h1>

        <p class="mx-auto mt-6 max-w-xl rounded-3xl border-2 border-lavender bg-white/60 px-6 py-4 text-center text-xl leading-relaxed">
            Loreberry punya banyak loker rahasia buat kamu. Buka satu-satu buat baca fakta seru pilihan Orby.
        </p>

        <p class="mx-auto mt-6 w-fit rounded-full border-2 border-lavender-dark bg-white/80 px-5 py-1">
            Aura hari ini: <span aria-hidden="true">✨</span> <span data-aura>{{ $aura }}</span> <span aria-hidden="true">✨</span>
        </p>
        <p class="mx-auto mt-4 max-w-xl text-center text-xl">
            Ada {{ count($loreberries) }} loker nih dari Orby buat kamu, seorang <span data-fase>{{ $fase }}</span>!
        </p>

        <div class="mt-8 grid items-center gap-10 md:grid-cols-2">
            <div class="relative rounded-2xl border-4 border-lavender bg-white p-6 shadow-lg md:max-w-sm md:justify-self-center">
                <x-stiker nama="pita-pink" class="absolute -right-6 -top-9 w-20 rotate-12" />
                <x-stiker nama="ceri" class="absolute -bottom-8 -left-6 w-14 -rotate-12" />

                <h2 class="font-display text-2xl uppercase">Misi hari ini</h2>
                <ul class="mt-3 flex flex-col gap-2">
                    @foreach ($aktivitas as $kegiatan)
                        <li>
                            {{-- Diisi otomatis oleh app.js; label sengaja dibuat tidak bisa diklik manual --}}
                            <label class="pointer-events-none flex items-center gap-3 text-2xl transition-opacity has-checked:line-through has-checked:opacity-60">
                                <input type="checkbox" data-tugas="{{ $kegiatan['kunci'] }}" tabindex="-1" class="h-5 w-5 accent-berry">
                                {{ $kegiatan['teks'] }}
                            </label>
                        </li>
                    @endforeach
                </ul>
                <p data-progres role="status" class="mt-3 text-lg text-berry">0 dari {{ count($aktivitas) }} selesai</p>
            </div>

            <div class="flex flex-col items-center">
                <p data-orby-bubble aria-live="polite" class="relative mb-4 max-w-xs rounded-3xl border-4 border-berry bg-white px-5 py-2 text-center text-xl shadow">
                    Halo, <span data-nama>{{ $username }}</span>! Yuk main-main ke lokerku.
                    <span class="absolute -bottom-3 left-1/2 h-4 w-4 -translate-x-1/2 rotate-45 border-b-4 border-r-4 border-berry bg-white" aria-hidden="true"></span>
                </p>
                <button type="button" data-orby-tilt data-orby-klik aria-label="Colek Orby"
                    class="flex h-72 w-72 cursor-pointer items-end justify-center rounded-3xl md:h-96 md:w-96">
                    <img src="{{ asset('assets/img/orby-beret.webp') }}" alt="Orby, maskot Loreberry yang melambai menyambutmu" width="470" height="560" fetchpriority="high" draggable="false"
                        class="max-h-full max-w-full select-none object-contain drop-shadow-lg">
                </button>
            </div>
        </div>
    </div>
</section>