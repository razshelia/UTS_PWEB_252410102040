// Pencarian loker di sisi klien. Modul terpisah agar kegagalan di app.js tidak ikut mematikannya.
const normal = (teks) => teks
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/[^\p{L}\p{N}]+/gu, ' ')
    .trim();

const mulai = () => {
    const form = document.querySelector('[data-form-cari]');
    const kolom = document.querySelector('#cari-loker');
    if (!form || !kolom) return;

    const kartu = [...document.querySelectorAll('[data-kartu]')];
    const info = document.querySelector('[data-hasil-cari]');
    const kosong = document.querySelector('[data-kosong]');
    const pembungkus = document.querySelector('[data-scroller]');
    const hapus = document.querySelector('[data-hapus-cari]');

    // Pakai hasil cari kalau ada, kalau tidak pakai seluruh teks kartu
    const teks = new Map(kartu.map((k) => [k, normal(k.dataset.cari || k.textContent)]));

    const saring = () => {
        const kata = normal(kolom.value).split(' ').filter(Boolean);
        let cocok = 0;

        kartu.forEach((k) => {
            const ada = kata.every((w) => teks.get(k).includes(w));
            k.style.display = ada ? '' : 'none';
            if (ada) cocok++;
        });

        if (info) {
            info.textContent = kata.length
                ? `${cocok} dari ${kartu.length} loker cocok`
                : `Menampilkan ${kartu.length} loker`;
        }

        if (kosong) kosong.classList.toggle('hidden', cocok !== 0);
        if (hapus) hapus.classList.toggle('hidden', kolom.value === '');
        if (pembungkus) pembungkus.scrollTo({ left: 0 });
        if (kata.length && cocok === 0) document.dispatchEvent(new CustomEvent('loker:kosong'));
    };

    kolom.addEventListener('input', saring);
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        saring();
    });

    if (hapus) {
        hapus.addEventListener('click', () => {
            kolom.value = '';
            saring();
            kolom.focus();
        });
    }

    saring();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mulai);
} else {
    mulai();
}