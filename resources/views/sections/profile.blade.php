<section id="profil" aria-labelledby="judul-profil" class="relative scroll-mt-20 overflow-hidden bg-polkadot py-14">
    <x-stiker nama="bunga-lilac" class="absolute left-[6%] top-10 hidden w-14 -rotate-12 md:block" />
    <x-stiker nama="kupu-pink" class="absolute right-[6%] top-16 hidden w-16 rotate-12 md:block" />
    <x-stiker nama="kilau-kuning" class="absolute bottom-10 left-[12%] w-10 animate-kelip" />

    <div class="relative mx-auto max-w-3xl px-4">
        <h2 id="judul-profil" class="judul-stiker text-center font-display text-4xl uppercase">Kartu identitas Loreberry</h2>

        <article class="relative mt-14 rounded-3xl border-8 border-double border-lavender bg-white/90 p-6 shadow-xl md:pr-44">
            <x-stiker nama="pita-lavender" class="absolute -left-8 -top-12 z-10 w-24 -rotate-12" />
            <x-stiker nama="pita-pink" class="absolute -right-6 -top-12 z-10 w-24 rotate-12" />
            <x-stiker nama="sudut-bunga" class="absolute -bottom-3 -left-3 w-14" />

            {{-- Edit disimulasikan di resources/js/profil.js --}}
            <form data-form-profil novalidate class="flex flex-col items-center gap-6 sm:flex-row sm:items-start">
                <div class="relative shrink-0 -rotate-3 bg-white p-2 pb-8 shadow-md">
                    <x-stiker nama="selotip-pink" class="absolute -top-5 left-1/2 w-16 -translate-x-1/2 rotate-3" />
                    <img src="{{ asset('assets/img/orby-kagum.webp') }}" alt="Foto profil {{ $username }}" width="450" height="534"
                        class="h-40 w-36 bg-blush/60 object-contain">
                    <p class="absolute inset-x-0 bottom-1 text-center text-base">Teman Orby</p>
                </div>

                <div class="w-full">
                    <dl class="w-full divide-y divide-blush text-2xl">
                        <div class="flex flex-wrap items-center gap-x-2 py-1">
                            <dt>Nama:</dt>
                            <dd class="min-w-0 flex-1">
                                <span data-tampil="nama" data-nama>{{ $username }}</span>
                                <input data-input="nama" type="text" maxlength="20" aria-label="Nama" autocomplete="off"
                                    class="hidden w-full rounded-xl border-2 border-bubble bg-white px-3 text-xl">
                            </dd>
                        </div>
                        <div class="flex gap-x-2 py-1"><dt>Peran:</dt><dd>{{ $peran }}</dd></div>
                        <div class="flex flex-wrap items-center gap-x-2 py-1">
                            <dt>Fase:</dt>
                            <dd class="min-w-0 flex-1">
                                <span data-tampil="fase" data-fase>{{ $fase }}</span>
                                <select data-input="fase" aria-label="Fase" class="hidden w-full rounded-xl border-2 border-bubble bg-white px-3 text-xl">
                                    @foreach ($daftarFase as $opsi)
                                        <option value="{{ $opsi['nama'] }}" data-singkat="{{ $opsi['singkat'] }}" data-aura="{{ $opsi['aura'] }}" @selected($opsi['nama'] === $fase)>{{ $opsi['nama'] }}</option>
                                    @endforeach
                                </select>
                            </dd>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-2 py-1">
                            <dt>Status:</dt>
                            <dd class="min-w-0 flex-1">
                                <span data-tampil="status">{{ $status }}</span>
                                <input data-input="status" type="text" maxlength="24" aria-label="Status" autocomplete="off"
                                    class="hidden w-full rounded-xl border-2 border-bubble bg-white px-3 text-xl">
                            </dd>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-2 py-1">
                            <dt>Bio:</dt>
                            <dd class="min-w-0 flex-1">
                                <span data-tampil="bio">{{ $bio }}</span>
                                <input data-input="bio" type="text" maxlength="50" aria-label="Bio" autocomplete="off"
                                    class="hidden w-full rounded-xl border-2 border-bubble bg-white px-3 text-xl">
                            </dd>
                        </div>
                        <div class="flex gap-x-2 py-1"><dt>Loker dibuka:</dt><dd data-counter>0</dd></div>
                        <div data-baris-lencana class="flex flex-wrap gap-x-2 rounded-lg py-1 transition-all">
                            <dt>Lencana:</dt>
                            <dd>
                                <span data-lencana-teks>Belum ada</span>
                                <button type="button" data-buka-kejutan aria-label="Lihat kejutan lagi" class="hidden text-left underline decoration-dotted underline-offset-4 transition-transform hover:text-berry active:scale-95">
                                    <span data-lencana-nama></span> <span class="text-base text-berry">(lihat kejutan)</span>
                                </button>
                            </dd>
                        </div>
                    </dl>

                    <p data-galat-profil role="alert" class="mt-2 hidden text-lg text-red-700"></p>

                    <div class="mt-3 flex flex-wrap gap-2">
                        <button type="button" data-edit-profil
                            class="rounded-full border-2 border-berry bg-white px-5 text-xl text-berry transition-transform hover:bg-berry hover:text-white active:scale-95">
                            <span aria-hidden="true">✏️</span> Edit profil
                        </button>
                        <button type="submit" data-simpan-profil
                            class="hidden rounded-full border-2 border-berry bg-berry px-5 text-xl text-white transition-transform hover:bg-ink active:scale-95 disabled:opacity-60">Simpan</button>
                        <button type="button" data-batal-profil
                            class="hidden rounded-full border-2 border-lavender-dark bg-white px-5 text-xl transition-transform hover:bg-lavender-light active:scale-95">Batal</button>
                    </div>
                    <p data-info-profil role="status" class="mt-2 text-lg text-berry"></p>
                </div>
            </form>

            <button type="button" data-orby-klik data-ekspresi="off" aria-label="Colek Orby wisuda"
                class="mx-auto mt-4 block w-40 cursor-pointer md:absolute md:-bottom-8 md:-right-6 md:mx-0 md:mt-0 md:w-44">
                <img src="{{ asset('assets/img/orby-wisuda.webp') }}" alt="Orby memakai toga wisuda" width="409" height="560" draggable="false" loading="lazy"
                    class="w-full select-none object-contain drop-shadow-md">
            </button>
        </article>
    </div>
</section>