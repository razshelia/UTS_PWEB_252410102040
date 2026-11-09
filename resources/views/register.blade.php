@extends('layouts.app')

@section('title', 'Daftar Loreberry | Buka Loker Fakta Ilmiah Gratis')
@section('description', 'Daftar di Loreberry, isi peran dan usiamu, lalu dapatkan surat rahasia dan pesan khusus dari Orby di setiap loker.')

@section('content')
<main id="konten" tabindex="-1" class="mx-auto flex w-full max-w-md flex-1 flex-col items-center justify-center px-4 py-10">
    <img src="{{ asset('assets/img/orby-berkebun.webp') }}" alt="Orby, maskot Loreberry sedang berkebun" width="507" height="529" fetchpriority="high" class="w-36 object-contain">
    
    <h1 class="judul-stiker mt-2 font-display text-4xl uppercase">Daftar Loker</h1>
    <p class="mt-1 text-center">Isi peran dan usiamu, Orby akan memilihkan pesan yang cocok untukmu.</p>

    <form action="/daftar" method="POST" class="mt-6 flex w-full flex-col gap-4 rounded-3xl border-4 border-berry bg-blush p-6 shadow-lg">
        @csrf
        <x-input label="Username" name="username" placeholder="3 sampai 20 karakter" autocomplete="username" required />
        <x-input label="Usia" name="usia" type="number" min="10" max="80" placeholder="contoh: 19" required />

        <div class="flex flex-col gap-1">
            @php
                $pesanPeran = $errors->first('peran');
                $idErrorPeran = 'peran-error';
            @endphp
            
            <label for="peran" class="font-medium">Peran</label>
            <select id="peran" name="peran" required
                @if ($pesanPeran) aria-invalid="true" aria-describedby="{{ $idErrorPeran }}" @endif
                class="rounded-2xl border-4 border-bubble bg-white px-4 py-2 text-ink">
                <option value="" disabled @selected(!old('peran'))>Pilih peranmu</option>
                @foreach ($daftarPeran as $peran)
                    <option value="{{ $peran }}" @selected(old('peran') === $peran)>{{ $peran }}</option>
                @endforeach
            </select>
            
            @if ($pesanPeran)
                <p id="{{ $idErrorPeran }}" class="text-sm font-medium text-red-700" role="alert">{{ $pesanPeran }}</p>
            @endif
        </div>

        <x-input label="Password" name="password" type="password" placeholder="minimal 6 karakter" autocomplete="new-password" required />
        <x-input label="Konfirmasi password" name="password_confirmation" type="password" autocomplete="new-password" required />

        <button type="submit" class="rounded-full border-4 border-berry bg-berry px-6 py-2 font-semibold text-white transition-transform hover:bg-ink active:scale-95">
            Buat akun
        </button>
    </form>

    <p class="mt-6 text-center text-sm">
        Sudah punya akun?
        <a href="/login" class="font-semibold text-berry underline">Masuk di sini</a>
    </p>

    <a href="/" class="mt-4 text-center text-sm underline">← Kembali ke beranda</a>
</main>
@endsection