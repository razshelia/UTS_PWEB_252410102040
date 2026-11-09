@extends('layouts.app')

@section('title', 'Loreberry | Fakta Ilmiah Manis di Setiap Loker')
@section('description', 'Loreberry adalah lorong loker digital berisi fakta ilmiah unik dan surat rahasia dari Orby. Daftar gratis untuk membuka lokermu.')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'Loreberry',
    'url' => url('/'),
    'inLanguage' => 'id',
    'description' => 'Lorong loker digital berisi fakta ilmiah unik dan surat rahasia dari Orby.',
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('nav')
    <x-navbar />
@endsection

@section('content')
<main id="konten" tabindex="-1">
    <section id="beranda" aria-labelledby="judul-beranda" class="relative scroll-mt-20 overflow-hidden bg-polos">
        <x-stiker nama="kupu-ungu" class="absolute left-[5%] top-8 hidden w-20 -rotate-12 animate-kelip md:block" />
        <x-stiker nama="kilau-kuning" class="absolute right-[7%] top-6 w-12 animate-kelip" />
        <x-stiker nama="kupu-pink" class="absolute right-[3%] top-1/2 hidden w-16 rotate-12 md:block" />
        <x-stiker nama="bunga-pink" class="absolute bottom-6 left-[3%] hidden w-14 rotate-12 md:block" />

        <div class="relative mx-auto grid max-w-6xl items-center gap-10 px-4 py-14 md:grid-cols-2">
            <div class="text-center md:text-left">
                <h1 id="judul-beranda" class="judul-stiker font-display text-4xl uppercase leading-tight md:text-6xl">
                    Loreberry: fakta ilmiah manis di setiap loker <span aria-hidden="true">🍓</span>
                </h1>
                <p class="mx-auto mt-5 max-w-md text-xl leading-relaxed md:mx-0">
                    Loreberry punya banyak loker rahasia buat kamu. Buka satu-satu buat baca fakta seru pilihan Orby.
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-3 md:justify-start">
                    <a href="/login" class="rounded-full border-4 border-berry bg-berry px-7 py-2 text-xl text-white transition-transform hover:bg-ink active:scale-95">Masuk</a>
                    <a href="/daftar" class="rounded-full border-4 border-berry bg-white px-7 py-2 text-xl text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">Daftar gratis</a>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <p data-orby-bubble aria-live="polite" class="relative mb-4 max-w-xs rounded-3xl border-4 border-berry bg-white px-5 py-2 text-center text-xl shadow">
                    Halo! Aku Orby. Yuk main-main ke lokerku.
                    <span class="absolute -bottom-3 left-1/2 h-4 w-4 -translate-x-1/2 rotate-45 border-b-4 border-r-4 border-berry bg-white" aria-hidden="true"></span>
                </p>
                <button type="button" data-orby-tilt data-orby-klik aria-label="Colek Orby"
                    class="flex h-72 w-72 cursor-pointer items-end justify-center rounded-3xl md:h-96 md:w-96">
                    <img src="{{ asset('assets/img/orby-beret.webp') }}" alt="Orby, maskot Loreberry yang melambai menyambutmu" width="470" height="560" fetchpriority="high" draggable="false"
                        class="max-h-full max-w-full select-none object-contain drop-shadow-lg">
                </button>
            </div>
        </div>
    </section>

    <section id="cara-kerja" aria-labelledby="judul-cara" class="relative scroll-mt-20 overflow-hidden bg-polkadot py-14">
        <x-stiker nama="bunga-lilac" class="absolute right-[6%] top-8 hidden w-14 rotate-12 md:block" />
        <div class="relative mx-auto max-w-5xl px-4">
            <h2 id="judul-cara" class="judul-stiker text-center font-display text-4xl uppercase">Cara kerjanya</h2>

            <ol class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ($langkah as $nomor => $item)
                    <li class="relative rounded-3xl border-4 border-lavender bg-white/90 p-6 pt-8 text-center shadow-lg">
                        <span class="absolute -top-5 left-1/2 grid h-10 w-10 -translate-x-1/2 place-items-center rounded-full border-4 border-white bg-berry font-display text-xl text-white">{{ $nomor + 1 }}</span>
                        <h3 class="font-display text-2xl uppercase">{{ $item['judul'] }}</h3>
                        <p class="mt-2 text-xl leading-snug">{{ $item['isi'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section id="loker" aria-labelledby="judul-loker" class="relative scroll-mt-20 overflow-hidden bg-kotak py-14">
        <x-stiker nama="kaktus" class="absolute bottom-4 left-[3%] hidden w-20 md:block" />
        <x-stiker nama="buku" class="absolute bottom-4 right-[3%] hidden w-28 md:block" />

        <div class="relative mx-auto max-w-6xl px-4">
            <div class="relative mx-auto w-[min(88vw,30rem)]">
                <x-stiker nama="pita-banner" class="w-full" />
                <h2 id="judul-loker" class="absolute inset-x-[16%] bottom-[30%] top-[24%] flex items-center justify-center font-display text-2xl uppercase text-ink md:text-4xl">
                    Lorong loker
                </h2>
            </div>

            <p class="mx-auto mt-4 max-w-md text-center text-xl">Semua loker masih terkunci. Masuk atau daftar dulu buat membukanya.</p>

            <div class="overflow-x-auto px-4 pb-2 pt-6">
                <div class="mx-auto w-max">
                    <ul class="flex -space-x-3">
                        @foreach ($teaser as $loker)
                            <li class="w-40 shrink-0 sm:w-44">
                                <a href="/login" aria-label="Loker nomor {{ $loker['nomor'] }} terkunci. Masuk dulu untuk membukanya."
                                    class="group relative block aspect-[422/950] transition-all duration-300 hover:-translate-y-2 hover:drop-shadow-[0_14px_12px_rgba(184,50,111,0.35)]">
                                    <img src="{{ asset('assets/img/loker-tutup.webp') }}" alt="" width="422" height="950" loading="lazy" draggable="false" class="h-full w-full select-none">
                                    <span class="absolute left-1/2 top-[8.6%] -translate-x-1/2 -translate-y-1/2 text-lg leading-none">{{ sprintf('%02d', $loker['nomor']) }}</span>
                                    <span class="absolute left-[27%] top-[22%] flex h-[15.6%] w-[49%] -rotate-2 flex-col items-center justify-center text-center leading-none">
                                        <span class="text-2xl">{{ $loker['emoji'] }}</span>
                                        <span class="mt-1 text-sm">Terkunci</span>
                                    </span>
                                    <span class="absolute left-1/2 top-[56%] -translate-x-1/2 text-4xl drop-shadow transition-transform group-hover:animate-goyang" aria-hidden="true">🔒</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="h-3 rounded-full bg-lavender-dark/40" aria-hidden="true"></div>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="/login" class="rounded-full border-4 border-berry bg-berry px-7 py-2 text-xl text-white transition-transform hover:bg-ink active:scale-95">Masuk</a>
                <a href="/daftar" class="rounded-full border-4 border-berry bg-white px-7 py-2 text-xl text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">Daftar gratis</a>
            </div>
        </div>
    </section>
</main>

<x-orby-kecil />
@endsection