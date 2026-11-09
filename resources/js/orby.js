// Interaksi maskot Orby dengan kursor
const gambarEkspresi = import.meta.glob('../assets/img/orby-*.webp', { eager: true, query: '?url', import: 'default' });

const urlEkspresi = (nama) => {
    const entri = Object.entries(gambarEkspresi).find(([path]) => path.endsWith(`orby-${nama}.webp`));
    return entri ? entri[1] : null;
};

const kurangiGerak = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const bisaPakaiKursor = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
const acak = (daftar) => daftar[Math.floor(Math.random() * daftar.length)];
const batasi = (angka, min, maks) => Math.max(min, Math.min(maks, angka));

const mainkan = (el, kelas, ms = 700) => {
    if (!el) return;
    el.classList.remove(kelas);
    void el.offsetWidth;
    el.classList.add(kelas);
    setTimeout(() => el.classList.remove(kelas), ms);
};

// Menahan wajah sampai dipulihkan manual
const ubahEkspresi = (img, nama, ms = 1200) => {
    if (!img) return;
    const url = urlEkspresi(nama);
    if (!url) return;
    if (!img.dataset.asli) img.dataset.asli = img.getAttribute('src');
    img.src = url;
    clearTimeout(img._timerEkspresi);
    if (ms > 0) img._timerEkspresi = setTimeout(() => { img.src = img.dataset.asli; }, ms);
};

const pulihkan = (img) => {
    if (!img) return;
    clearTimeout(img._timerEkspresi);
    if (img.dataset.asli) img.src = img.dataset.asli;
};

// Hujan partikel dekoratif di titik tertentu
const hujan = (x, y, daftar = ['💖', '✨', '🍓', '🎀', '🌸']) => {
    if (kurangiGerak) return;
    const induk = document.querySelector('dialog[open]') || document.body;
    for (let i = 0; i < 8; i++) {
        const s = document.createElement('span');
        s.textContent = acak(daftar);
        s.className = 'partikel';
        s.setAttribute('aria-hidden', 'true');
        s.style.left = `${x}px`;
        s.style.top = `${y}px`;
        s.style.setProperty('--tx', `${Math.random() * 120 - 60}px`);
        s.style.setProperty('--ty', `${-40 - Math.random() * 90}px`);
        s.style.setProperty('--rot', `${Math.random() * 60 - 30}deg`);
        induk.appendChild(s);
        setTimeout(() => s.remove(), 900);
    }
};

const tengah = (el) => {
    const r = el.getBoundingClientRect();
    return { x: r.left + r.width / 2, y: r.top + r.height / 2 };
};

document.addEventListener('DOMContentLoaded', () => {
    // Orby besar miring dan bergeser mengikuti kursor
    const utama = document.querySelector('[data-orby-tilt]');
    if (utama && !kurangiGerak && bisaPakaiKursor) {
        let targetX = 0, targetY = 0, nowX = 0, nowY = 0, terlihat = true;

        new IntersectionObserver(([e]) => { terlihat = e.isIntersecting; }).observe(utama);

        window.addEventListener('pointermove', (e) => {
            const c = tengah(utama);
            targetX = batasi((e.clientX - c.x) / (window.innerWidth / 2), -1, 1);
            targetY = batasi((e.clientY - c.y) / (window.innerHeight / 2), -1, 1);
        });

        const putar = () => {
            if (terlihat) {
                nowX += (targetX - nowX) * 0.1;
                nowY += (targetY - nowY) * 0.1;
                utama.style.transform =
                    `perspective(700px) rotateY(${nowX * 14}deg) rotateX(${-nowY * 10}deg) translate(${nowX * 10}px, ${nowY * 8}px)`;
            }
            requestAnimationFrame(putar);
        };
        putar();
    }

    const kalimat = ['Hehe, geli tau!', 'Yay, kamu datang!', 'Mau lihat surat rahasia?', 'Orby suka stroberi', 'Colek lagi dong~'];
    const gelembung = document.querySelector('[data-orby-bubble]');

    // Klik Orby dimana pun: lompat, ganti wajah sebentar, hujan partikel
    document.querySelectorAll('[data-orby-klik]').forEach((tombol) => {
        const img = tombol.querySelector('img');
        tombol.addEventListener('click', (e) => {
            const t = tengah(tombol);
            mainkan(img, 'animate-lompat');
            if (tombol.dataset.ekspresi !== 'off') ubahEkspresi(img, acak(['makan', 'kagum']), 1400);
            if (gelembung && tombol.hasAttribute('data-orby-tilt')) {
                gelembung.textContent = acak(kalimat);
                mainkan(gelembung, 'animate-pop', 300);
            }
            hujan(e.clientX || t.x, e.clientY || t.y);
        });
    });

    // Bubble Orby besar di kejutan
    document.addEventListener('tugas:selesai', () => {
        if (gelembung) {
            gelembung.textContent = 'Semua tugas selesai. Kamu hebat.';
            mainkan(gelembung, 'animate-pop', 300);
        }
    });

    document.addEventListener('profil:diubah', (e) => {
        if (gelembung) {
            gelembung.textContent = `Halo ${e.detail.nama}, namamu bagus banget.`;
            mainkan(gelembung, 'animate-pop', 300);
        }
        const form = document.querySelector('[data-form-profil]');
        if (form) {
            const t = tengah(form);
            hujan(t.x, t.y, ['💖', '✨', '🎀']);
        }
    });

    // Orby kecil yang mengikuti kursor
    const kecil = document.querySelector('[data-orby-kecil]');
    const gambarKecil = kecil ? kecil.querySelector('[data-orby-kecil-img]') : null;
    const gelembungKecil = kecil ? kecil.querySelector('[data-orby-kecil-bubble]') : null;
    const tombolIkut = document.querySelector('[data-orby-ikut]');

    if (!kecil || !gambarKecil || !gelembungKecil || !tombolIkut) return;
    if (!bisaPakaiKursor || kurangiGerak) return;

    let ikut = true;
    let mx = -200, my = -200, x = -200, y = -200, arah = 1, tidur = false, terakhirGerak = Date.now();
    let timerBicara;

    const ucapKecil = (teks, ms = 1800) => {
        gelembungKecil.textContent = teks;
        gelembungKecil.classList.remove('hidden');
        mainkan(gelembungKecil, 'animate-pop', 300);
        clearTimeout(timerBicara);
        timerBicara = setTimeout(() => gelembungKecil.classList.add('hidden'), ms);
    };

    const reaksi = (teks, ekspresi, gerak) => {
        if (!ikut) return;
        ucapKecil(teks);
        ubahEkspresi(gambarKecil, ekspresi, 1400);
        mainkan(gambarKecil, gerak);
    };

    // Dialog memakai top layer; naikkan Orby kecil supaya tidak tertutup
    const naikkan = () => {
        if (!ikut) return;
        if (kecil.matches(':popover-open')) kecil.hidePopover();
        kecil.showPopover();
    };

    kecil.showPopover();
    tombolIkut.classList.remove('hidden');

    window.addEventListener('pointermove', (e) => {
        if (!ikut) return;
        if (kecil.classList.contains('opacity-0')) { x = e.clientX; y = e.clientY; kecil.classList.remove('opacity-0'); }
        mx = e.clientX;
        my = e.clientY;
        terakhirGerak = Date.now();
        if (tidur) {
            tidur = false;
            gambarKecil.classList.remove('animate-napas');
            pulihkan(gambarKecil);
            reaksi('Kamu balik.', 'makan', 'animate-lompat');
        }
    });

    const gelung = () => {
        if (ikut) {
            const vx = mx + 24 - x;
            x += vx * 0.14;
            y += (my + 20 - y) * 0.14;
            if (Math.abs(vx) > 3) arah = vx > 0 ? 1 : -1;
            kecil.style.transform = `translate(${x}px, ${y}px)`;
            gambarKecil.style.transform = `scaleX(${arah}) rotate(${batasi(vx * 0.25, -14, 14) * arah}deg)`;

            if (!tidur && Date.now() - terakhirGerak > 6000) {
                tidur = true;
                ubahEkspresi(gambarKecil, 'tidur', 0);
                gambarKecil.classList.add('animate-napas');
                ucapKecil('Zzz...', 4000);
            }
        }
        requestAnimationFrame(gelung);
    };
    gelung();

    document.querySelectorAll('[data-loker]').forEach((pintu) => {
        pintu.addEventListener('pointerenter', () => reaksi(`Loker No. ${pintu.dataset.nomor}.`, 'penasaran', 'animate-goyang'));
        pintu.addEventListener('click', (e) => {
            reaksi('Wah, ada surat.', 'kagum', 'animate-lompat');
            hujan(e.clientX, e.clientY, ['💌', '✨', '💖']);
        });
    });

    // setTimeout(0) supaya app.js sempat menulis aria-pressed lebih dulu
    document.querySelectorAll('[data-toggle]').forEach((tombolAksi) => {
        tombolAksi.addEventListener('click', (e) => {
            setTimeout(() => {
                const nyala = tombolAksi.getAttribute('aria-pressed') === 'true';
                const suka = tombolAksi.dataset.toggle === 'suka';
                if (nyala) {
                    reaksi(suka ? 'Makasih.' : 'Disimpan.', suka ? 'makan' : 'kagum', 'animate-lompat');
                    hujan(e.clientX, e.clientY, suka ? ['💖', '💗'] : ['📌', '✨']);
                } else {
                    reaksi(suka ? 'Yah, batal...' : 'Oke, dilepas.', 'penasaran', 'animate-goyang');
                }
            }, 0);
        });
    });

    document.addEventListener('tugas:selesai', () => reaksi('Yeay, semua selesai.', 'kagum', 'animate-lompat'));
    document.addEventListener('profil:diubah', () => reaksi('Profil baru.', 'makan', 'animate-lompat'));

    const kolomCari = document.querySelector('#cari-loker');
    if (kolomCari) {
        kolomCari.addEventListener('focus', () => reaksi('Cari apa nih?', 'penasaran', 'animate-goyang'));
    }
    document.addEventListener('loker:kosong', () => reaksi('Hmm, tidak ketemu.', 'penasaran', 'animate-goyang'));

    document.querySelectorAll('dialog[data-surat], dialog[data-kejutan]').forEach((d) => {
        new MutationObserver(() => { if (d.open) naikkan(); }).observe(d, { attributes: true, attributeFilter: ['open'] });
    });

    tombolIkut.addEventListener('click', () => {
        ikut = !ikut;
        tombolIkut.setAttribute('aria-pressed', String(ikut));
        if (ikut) {
            if (!kecil.matches(':popover-open')) kecil.showPopover();
        } else if (kecil.matches(':popover-open')) {
            kecil.hidePopover();
        }
    });
});