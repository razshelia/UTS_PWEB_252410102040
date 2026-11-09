@extends('layouts.app')

@section('title', 'Masuk ke Loreberry | Fakta Ilmiah Manis di Setiap Loker')
@section('description', 'Masuk ke Loreberry, lorong loker digital berisi fakta ilmiah unik dan surat rahasia dari Orby. Daftar gratis untuk membuka lokermu.')

@section('content')
<main id="konten" tabindex="-1" class="mx-auto flex w-full max-w-md flex-1 flex-col items-center justify-center px-4 py-10">
    <img src="{{ asset('assets/img/orby-beret.webp') }}" alt="Orby, maskot Loreberry" width="470" height="560" fetchpriority="high" class="w-40 object-contain">
    
    <h1 class="judul-stiker mt-2 font-display text-4xl uppercase">Loreberry</h1>
    <p class="mt-1 text-center">Masuk untuk membuka lokermu.</p>

    @if (session('error'))
        <p role="alert" class="mt-4 w-full rounded-2xl border-4 border-red-700 bg-white p-3 text-center text-sm font-medium text-red-700">{{ session('error') }}</p>
    @endif
    @if (session('success'))
        <p role="status" class="mt-4 w-full rounded-2xl border-4 border-berry bg-white p-3 text-center text-sm font-medium text-berry">{{ session('success') }}</p>
    @endif

    <form action="/login" method="POST" class="mt-6 flex w-full flex-col gap-4 rounded-3xl border-4 border-berry bg-blush p-6 shadow-lg">
        @csrf
        <x-input label="Username" name="username" placeholder="contoh: berry" autocomplete="username" required />
        <x-input label="Password" name="password" type="password" autocomplete="current-password" required />

        <button type="submit" class="rounded-full border-4 border-berry bg-berry px-6 py-2 font-semibold text-white transition-transform hover:bg-ink active:scale-95">
            Masuk ke loker
        </button>
    </form>

    <p class="mt-6 text-center text-sm">
        Belum punya loker?
        <a href="/daftar" class="font-semibold text-berry underline">Daftar dulu</a>
        dan isi usiamu, supaya pesan di setiap loker terasa dekat denganmu.
    </p>

    <a href="/" class="mt-4 text-center text-sm underline">← Kembali ke beranda</a>
</main>
@endsection