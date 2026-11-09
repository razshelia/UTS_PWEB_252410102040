@props(['username' => null])

{{-- $username kosong = pengunjung belum login --}}
<header class="pointer-events-none sticky top-0 z-50 px-3 pt-3">
    <nav aria-label="Navigasi utama"
        class="pointer-events-auto relative mx-auto flex max-w-6xl items-center justify-between gap-4 rounded-full border border-white/60 bg-white/35 px-5 py-2 shadow-[0_8px_30px_rgba(184,50,111,0.15)] backdrop-blur-xl backdrop-saturate-150">
        <a href="{{ $username ? '#dashboard' : '#beranda' }}" class="font-display text-2xl uppercase tracking-wide text-ink">
            Loreberry <span aria-hidden="true">🍓</span>
        </a>

        <button id="menu-toggle" type="button" aria-expanded="false" aria-controls="menu-list" aria-label="Buka atau tutup menu"
            class="rounded-xl border-2 border-berry px-3 py-0.5 text-xl text-berry transition-transform active:scale-95 sm:hidden">
            <span aria-hidden="true">☰</span>
        </button>

        <ul id="menu-list"
            class="absolute left-0 right-0 top-full mt-2 hidden flex-col gap-1 rounded-3xl border border-white/60 bg-white/70 p-4 shadow-lg backdrop-blur-xl sm:static sm:mt-0 sm:flex sm:flex-row sm:items-center sm:rounded-none sm:border-0 sm:bg-transparent sm:p-0 sm:shadow-none sm:backdrop-blur-none">
            @if ($username)
                <li><a data-nav href="#dashboard" aria-current="true" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Dashboard</a></li>
                <li><a data-nav href="#loker" aria-current="false" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Lorong Loker</a></li>
                <li><a data-nav href="#profil" aria-current="false" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Profil</a></li>
                <li>
                    <form action="/logout" method="POST" class="flex items-center gap-2 sm:pl-2">
                        @csrf
                        <span class="text-sm"><span aria-hidden="true">🎀</span> <span data-nama>{{ $username }}</span></span>
                        <button type="submit" class="rounded-full border-2 border-berry px-4 py-0.5 text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">Keluar</button>
                    </form>
                </li>
            @else
                <li><a data-nav href="#beranda" aria-current="true" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Beranda</a></li>
                <li><a data-nav href="#cara-kerja" aria-current="false" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Cara Kerja</a></li>
                <li><a data-nav href="#loker" aria-current="false" class="block rounded-full px-4 py-1 text-ink transition-colors hover:bg-white/60 aria-[current=true]:bg-berry aria-[current=true]:text-white">Lorong Loker</a></li>
                <li class="flex items-center gap-2 pt-1 sm:pl-2 sm:pt-0">
                    <a href="/login" class="rounded-full border-2 border-berry px-4 py-0.5 text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">Masuk</a>
                    <a href="/daftar" class="rounded-full border-2 border-berry bg-berry px-4 py-0.5 text-white transition-transform hover:bg-ink active:scale-95">Daftar</a>
                </li>
            @endif
        </ul>
    </nav>
</header>