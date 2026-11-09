<section id="loker" aria-labelledby="judul-loker" class="relative scroll-mt-20 overflow-hidden bg-kotak py-14">
    <x-stiker nama="kaktus" class="absolute bottom-4 left-[3%] hidden w-20 md:block" />
    <x-stiker nama="buku" class="absolute bottom-4 right-[3%] hidden w-28 md:block" />
    <x-stiker nama="kilau-kuning" class="absolute right-[12%] top-8 w-10 animate-kelip" />

    <div class="relative mx-auto max-w-6xl px-4">
        <div class="relative mx-auto w-[min(88vw,30rem)]">
            <x-stiker nama="pita-banner" class="w-full" />
            <h2 id="judul-loker" class="absolute inset-x-[16%] bottom-[30%] top-[24%] flex items-center justify-center font-display text-2xl uppercase text-ink md:text-4xl">
                Lorong loker
            </h2>
        </div>

        <div class="relative mx-auto mt-4 w-52">
            <x-stiker nama="orby-papan" class="w-full" />
            <p class="absolute inset-x-[12%] bottom-[10%] top-[58%] flex items-center justify-center text-center text-lg leading-tight">
                Klik loker untuk membuka suratnya!
            </p>
        </div>

        {{-- Filter di resources/js/cari.js --}}
        <form data-form-cari role="search" class="mx-auto mt-8 flex max-w-xl flex-col gap-2">
            <label for="cari-loker" class="sr-only">Cari loker</label>
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xl" aria-hidden="true">🔍</span>
                    <input id="cari-loker" name="q" type="search" autocomplete="off" placeholder="Mau cari fakta apa hari ini?"
                        class="w-full rounded-full border-4 border-bubble bg-white py-2 pl-12 pr-11 text-xl placeholder:text-bubble/60 [&::-webkit-search-cancel-button]:hidden">
                    <button type="button" data-hapus-cari aria-label="Hapus pencarian"
                        class="absolute right-3 top-1/2 hidden h-7 w-7 -translate-y-1/2 rounded-full bg-blush text-base text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">✕</button>
                </div>
                <button type="submit"
                    class="rounded-full border-4 border-berry bg-berry px-5 text-xl text-white transition-transform hover:bg-ink active:scale-95">Cari</button>
            </div>
            <p data-hasil-cari role="status" class="text-center text-lg">Menampilkan {{ count($loreberries) }} loker</p>
        </form>

        {{-- Fake loading: skeleton tampil 1,5 detik (diatur di resources/js/app.js) --}}
        <div id="loker-skeleton" role="status" class="mt-6">
            <p class="sr-only">Memuat loker...</p>
            <div class="flex -space-x-3 overflow-hidden px-4 pb-6 pt-4 md:px-16" aria-hidden="true">
                @foreach ($loreberries as $item)
                    <div class="aspect-[422/950] w-44 shrink-0 animate-pulse rounded-3xl border-4 border-gray-200 bg-gray-100"></div>
                @endforeach
            </div>
        </div>

        <div id="loker-grid" class="relative mt-6 hidden">
            {{-- Tombol geser (desktop); di layar sentuh cukup swipe --}}
            <button type="button" data-geser="-1" aria-label="Geser loker ke kiri"
                class="absolute left-0 top-1/2 z-10 hidden h-12 w-12 -translate-y-1/2 place-items-center rounded-full border-4 border-berry bg-white text-3xl leading-none text-berry shadow transition-transform hover:bg-berry hover:text-white active:scale-95 md:grid">‹</button>
            <button type="button" data-geser="1" aria-label="Geser loker ke kanan"
                class="absolute right-0 top-1/2 z-10 hidden h-12 w-12 -translate-y-1/2 place-items-center rounded-full border-4 border-berry bg-white text-3xl leading-none text-berry shadow transition-transform hover:bg-berry hover:text-white active:scale-95 md:grid">›</button>

            <div data-scroller tabindex="0" role="region" aria-label="Deretan loker, geser ke samping untuk melihat semuanya"
                class="snap-x snap-mandatory overflow-x-auto px-4 pb-6 pt-4 [scrollbar-color:#ff8fc7_transparent] md:px-16">
                {{-- Deretan loker menempel berdiri di atas lantai --}}
                <div class="w-max min-w-full">
                    <div class="flex items-start -space-x-3">
                        @foreach ($loreberries as $item)
                            <article data-kartu data-cari="{{ $item['cari'] }}" class="flex w-44 shrink-0 snap-center flex-col items-center">
                                {{-- Loker: gambar tertutup berganti gambar terbuka saat diklik --}}
                                <button type="button" id="pintu-{{ $item['nomor'] }}" data-loker data-nomor="{{ sprintf('%02d', $item['nomor']) }}"
                                    aria-expanded="false" aria-haspopup="dialog" aria-controls="surat-{{ $item['nomor'] }}"
                                    aria-label="Buka loker nomor {{ $item['nomor'] }}: {{ $item['judul'] }}"
                                    class="group relative aspect-[422/950] w-full cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:drop-shadow-[0_14px_12px_rgba(184,50,111,0.35)] aria-expanded:z-20">

                                    <span class="absolute inset-0 transition-opacity duration-300 group-aria-expanded:opacity-0">
                                        <img src="{{ asset('assets/img/loker-tutup.webp') }}" alt="" width="422" height="950" draggable="false" class="h-full w-full select-none">
                                        <span class="absolute left-1/2 top-[8.6%] -translate-x-1/2 -translate-y-1/2 text-lg leading-none">{{ sprintf('%02d', $item['nomor']) }}</span>
                                        <span class="absolute left-[27%] top-[22%] flex h-[15.6%] w-[49%] -rotate-2 flex-col items-center justify-center text-center leading-none">
                                            <span class="text-2xl">{{ $item['emoji'] }}</span>
                                            <span class="mt-1 text-sm">Buka aku!</span>
                                        </span>
                                    </span>

                                    <img src="{{ asset('assets/img/loker-buka.webp') }}" alt="" width="473" height="950" draggable="false"
                                        class="absolute left-0 top-0 h-full w-[112%] max-w-none select-none object-contain opacity-0 transition-opacity duration-300 group-aria-expanded:opacity-100">
                                </button>

                                <h3 class="mt-3 px-3 text-center text-lg leading-snug">{{ $item['judul'] }}</h3>
                                <p class="text-center font-display text-sm uppercase text-berry">{{ $item['kategori'] }}</p>

                                <dialog id="surat-{{ $item['nomor'] }}" data-surat aria-labelledby="judul-surat-{{ $item['nomor'] }}"
                                    class="m-auto w-[min(92vw,28rem)] max-w-none overflow-visible bg-transparent p-0 text-ink">
                                    <div class="relative -rotate-1">
                                        <x-stiker nama="selotip-ungu" class="absolute -left-4 -top-7 z-20 w-24 -rotate-12" />
                                        <x-stiker nama="selotip-pink" class="absolute -right-3 -top-7 z-20 w-24 rotate-12" />

                                        <div class="kertas-surat relative rounded-md shadow-2xl">
                                            <button type="button" data-tutup aria-label="Tutup surat"
                                                class="absolute right-2 top-2 z-30 grid h-9 w-9 place-items-center rounded-full border-2 border-berry bg-white text-lg text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">✕</button>

                                            <div class="max-h-[82dvh] overflow-y-auto p-6 pb-8 pl-14 pt-9">
                                                <p class="font-display text-lg uppercase text-berry">Surat rahasia dari Orby</p>
                                                <h3 id="judul-surat-{{ $item['nomor'] }}" class="mt-1 pr-8 font-display text-3xl uppercase leading-tight">{{ $item['judul'] }}</h3>
                                                <p class="mt-2 inline-block rounded-full bg-lavender-light px-3 font-display text-sm uppercase">{{ $item['kategori'] }}</p>

                                                <div class="relative mt-5 flex -rotate-1 items-center gap-3 rounded-2xl border-4 border-dashed border-bubble bg-blush/70 p-3">
                                                    <x-stiker nama="stroberi" class="absolute -right-5 -top-6 w-10 rotate-12" />
                                                    <p class="font-display text-4xl uppercase leading-none text-berry">{{ $item['sorotan']['angka'] }}</p>
                                                    <p class="text-xl leading-snug">{{ $item['sorotan']['label'] }}</p>
                                                </div>

                                                <p class="mt-4 text-xl">{{ $item['fakta'] }}</p>

                                                <p class="mt-3 text-berry">Fakta kilat</p>
                                                <ul class="mt-1 space-y-1 text-xl">
                                                    @foreach ($item['poin'] as $poin)
                                                        <li class="flex gap-2">
                                                            <span class="mt-2 h-3 w-3 shrink-0 rounded-full bg-bubble" aria-hidden="true"></span>
                                                            {{ $poin }}
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <div class="relative mt-6 rotate-1 rounded-sm bg-yellow-100 p-4 pt-5 shadow-md">
                                                    <x-stiker nama="selotip-pink" class="absolute -top-5 left-1/2 w-16 -translate-x-1/2 -rotate-3" />
                                                    <div class="flex items-center gap-2">
                                                        <img src="{{ asset('assets/img/orby-beret.webp') }}" alt="" aria-hidden="true"
                                                            class="h-11 w-11 shrink-0 rounded-full border-2 border-berry bg-white object-cover object-top">
                                                        <p class="text-xl text-berry">Pesan Orby (Fase <span data-fase-singkat>{{ $faseSingkat }}</span>)</p>
                                                    </div>
                                                    <p class="mt-2 text-xl">{{ $item['pesan'] }}</p>
                                                    <p class="mt-1 text-xl italic">{{ $item['pesan_usia'] }}</p>
                                                </div>

                                                <ul class="mt-4 flex flex-wrap gap-2 text-base">
                                                    <li class="rounded-full bg-lavender-light px-3">Untuk {{ $peran }}</li>
                                                    <li class="rounded-full bg-lavender-light px-3">{{ $labelKelompok }}</li>
                                                </ul>

                                                <div class="mt-4 flex items-center gap-3">
                                                    <button type="button" data-toggle="suka" aria-pressed="false"
                                                        class="rounded-full border-2 border-berry bg-white px-4 text-lg text-berry transition-transform active:scale-95 aria-pressed:bg-berry aria-pressed:text-white">
                                                        <span aria-hidden="true">💖</span> Suka
                                                    </button>
                                                    <button type="button" data-toggle="simpan" aria-pressed="false"
                                                        class="rounded-full border-2 border-berry bg-white px-4 text-lg text-berry transition-transform active:scale-95 aria-pressed:bg-berry aria-pressed:text-white">
                                                        <span aria-hidden="true">📌</span> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dialog>
                            </article>
                        @endforeach
                    </div>
                    {{-- Lantai lorong --}}
                    <div class="h-3 rounded-full bg-lavender-dark/40" aria-hidden="true"></div>
                </div>
            </div>

            <div data-kosong class="hidden px-4 py-6 text-center">
                <x-stiker nama="orby-penasaran" class="mx-auto w-32" />
                <p class="mt-2 text-xl">Belum ada loker yang cocok. Coba kata kunci lain ya!</p>
            </div>
        </div>
    </div>
</section>