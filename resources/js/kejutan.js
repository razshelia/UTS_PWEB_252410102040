// Kejutan misi selesai

const warna = ['#ff8fc7', '#cdb9ee', '#fde68a', '#b8326f', '#a5d8ff', '#ffffff', '#9be3c3'];
const kurangiGerak = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const acak = (min, maks) => min + Math.random() * (maks - min);

let frame = null;
let timerHujan = null;

const hentikan = (kanvas) => {
    if (frame !== null) {
        cancelAnimationFrame(frame);
        frame = null;
    }

    if (timerHujan !== null) {
        clearTimeout(timerHujan);
        timerHujan = null;
    }

    if (kanvas.matches(':popover-open')) kanvas.hidePopover();
};

const luncurkan = (kanvas) => {
    const dpr = window.devicePixelRatio || 1;
    const lebar = window.innerWidth;
    const tinggi = window.innerHeight;

    kanvas.width = lebar * dpr;
    kanvas.height = tinggi * dpr;

    const ctx = kanvas.getContext('2d');
    if (!ctx) return;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    const potongan = [];
    const tambah = (x, y, sudut, kuat) => {
        potongan.push({
            x, y,
            vx: Math.cos(sudut) * kuat,
            vy: Math.sin(sudut) * kuat,
            rot: acak(0, Math.PI * 2),
            vr: acak(-0.3, 0.3),
            w: acak(7, 13),
            h: acak(4, 8),
            warna: warna[Math.floor(Math.random() * warna.length)],
            umur: 0,
        });
    };

    // Party popper
    for (let i = 0; i < 70; i++) {
        tambah(0, tinggi, acak(-Math.PI / 2.6, -Math.PI / 5), acak(12, 24));
        tambah(lebar, tinggi, acak(-Math.PI + Math.PI / 5, -Math.PI + Math.PI / 2.6), acak(12, 24));
    }

    // Hujan konfeti
    timerHujan = setTimeout(() => {
        timerHujan = null;
        for (let i = 0; i < 90; i++) tambah(acak(0, lebar), acak(-80, -10), Math.PI / 2, acak(1, 4));
    }, 700);

    const mulaiWaktu = performance.now();

    const gambar = (sekarang) => {
        ctx.clearRect(0, 0, lebar, tinggi);

        potongan.forEach((p) => {
            p.vy += 0.35;
            p.vx *= 0.985;
            p.vy *= 0.985;
            p.x += p.vx;
            p.y += p.vy;
            p.rot += p.vr;
            p.umur++;

            ctx.save();
            ctx.globalAlpha = Math.max(0, 1 - Math.max(0, p.umur - 120) / 90);
            ctx.translate(p.x, p.y);
            ctx.rotate(p.rot);
            ctx.fillStyle = p.warna;
            ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
            ctx.restore();
        });

        if (sekarang - mulaiWaktu < 4800) {
            frame = requestAnimationFrame(gambar);
        } else {
            hentikan(kanvas);
        }
    };

    frame = requestAnimationFrame(gambar);
};

const gerakHalus = kurangiGerak ? 'auto' : 'smooth';

const mulai = () => {
    const dialog = document.querySelector('[data-kejutan]');
    const kanvas = document.querySelector('[data-konfeti]');
    if (!dialog || !kanvas) return;

    const teksLencana = document.querySelector('[data-lencana-teks]');
    const tombolLihat = document.querySelector('[data-buka-kejutan]');
    const namaLencana = document.querySelector('[data-lencana-nama]');
    const keProfil = dialog.querySelector('[data-ke-profil]');

    const tampilkan = () => {
        if (dialog.open) return;
        dialog.showModal();
        if (!kurangiGerak) {
            kanvas.showPopover();
            luncurkan(kanvas);
        }
    };

    const catatLencana = () => {
        if (!tombolLihat || !namaLencana) return;
        namaLencana.textContent = `🏅 ${dialog.dataset.lencana}`;
        tombolLihat.classList.remove('hidden');
        if (teksLencana) teksLencana.classList.add('hidden');
    };

    document.addEventListener('tugas:selesai', () => {
        // Jeda supaya centang terakhir sempat terlihat
        setTimeout(() => {
            catatLencana();
            tampilkan();
        }, 700);
    });

    if (tombolLihat) tombolLihat.addEventListener('click', tampilkan);

    // Tutup semua dialog lalu gulir ke profil
    if (keProfil) {
        keProfil.addEventListener('click', () => {
            document.querySelectorAll('dialog[open]').forEach((d) => d.close());

            // Jeda: browser mengembalikan fokus ke tombol terakhir saat dialog ditutup
            setTimeout(() => {
                document.querySelector('#profil').scrollIntoView({ behavior: gerakHalus, block: 'start' });

                const baris = document.querySelector('[data-baris-lencana]');
                if (baris) {
                    baris.classList.add('ring-4', 'ring-bubble', 'bg-blush/60', 'px-2');
                    setTimeout(() => baris.classList.remove('ring-4', 'ring-bubble', 'bg-blush/60', 'px-2'), 2800);
                }
            }, 80);
        });
    }

    dialog.addEventListener('close', () => hentikan(kanvas));
    dialog.addEventListener('click', (e) => { if (e.target === dialog) dialog.close(); });
    dialog.querySelectorAll('[data-tutup]').forEach((t) => t.addEventListener('click', () => dialog.close()));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mulai);
} else {
    mulai();
}