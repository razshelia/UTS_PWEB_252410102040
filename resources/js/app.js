import './orby';
import './cari';
import './profil';
import './kejutan';

// Build asset
import.meta.glob(['../assets/img/**', '../assets/fonts/**']);

document.addEventListener('DOMContentLoaded', () => {
    // Hamburger
    const toggle = document.querySelector('#menu-toggle');
    const list = document.querySelector('#menu-list');

    if (toggle && list) {
        toggle.addEventListener('click', () => {
            const terbuka = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!terbuka));
            list.classList.toggle('hidden');
            list.classList.toggle('flex');
        });
    }

    // Menu yang tampil di layar
    const tautan = document.querySelectorAll('[data-nav]');
    const bagian = ['beranda', 'cara-kerja', 'dashboard', 'loker', 'profil']
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    if (tautan.length && 'IntersectionObserver' in window) {
        const pengamat = new IntersectionObserver((entri) => {
            entri.forEach((e) => {
                if (e.isIntersecting) {
                    tautan.forEach((t) => {
                        t.setAttribute('aria-current', String(t.getAttribute('href') === '#' + e.target.id));
                    });
                }
            });
        }, { rootMargin: '-40% 0px -55% 0px' });

        bagian.forEach((b) => pengamat.observe(b));
    }

    // Skeleton
    const skeleton = document.querySelector('#loker-skeleton');
    const grid = document.querySelector('#loker-grid');

    if (skeleton && grid) {
        setTimeout(() => {
            skeleton.classList.add('hidden');
            grid.classList.remove('hidden');
        }, 1500);
    }

    // Klik loker lalu surat muncul
    const dibuka = new Set();
    const penghitung = document.querySelectorAll('[data-counter]');
    const perbaruiHitungan = () => penghitung.forEach((el) => { el.textContent = dibuka.size; });

    document.querySelectorAll('[data-loker]').forEach((pintu) => {
        const surat = document.getElementById(pintu.getAttribute('aria-controls'));
        if (!surat) return;

        pintu.addEventListener('click', () => {
            const r = pintu.getBoundingClientRect();
            surat.style.setProperty('--dx', `${r.left + r.width / 2 - window.innerWidth / 2}px`);
            surat.style.setProperty('--dy', `${r.top + r.height / 2 - window.innerHeight / 2}px`);
            pintu.setAttribute('aria-expanded', 'true');
            surat.showModal();
            dibuka.add(pintu.id);
            perbaruiHitungan();
        });

        // Tutup lewat tombol silang, area gelap, atau Esc
        surat.addEventListener('close', () => pintu.setAttribute('aria-expanded', 'false'));
        surat.addEventListener('click', (e) => { if (e.target === surat) surat.close(); });
        surat.querySelectorAll('[data-tutup]').forEach((t) => t.addEventListener('click', () => surat.close()));
    });
    perbaruiHitungan();

    // Tombol suka/simpan
    document.querySelectorAll('[data-toggle]').forEach((tombol) => {
        tombol.addEventListener('click', () => {
            const aktif = tombol.getAttribute('aria-pressed') === 'true';
            tombol.setAttribute('aria-pressed', String(!aktif));
        });
    });

    // Scroller loker
    const pembungkus = document.querySelector('[data-scroller]');
    const gerakHalus = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';

    document.querySelectorAll('[data-geser]').forEach((tombol) => {
        tombol.addEventListener('click', () => {
            if (!pembungkus) return;
            pembungkus.scrollBy({
                left: Number(tombol.dataset.geser) * pembungkus.clientWidth * 0.8,
                behavior: gerakHalus,
            });
        });
    });

    // Checklist 
    const progres = document.querySelector('[data-progres]');

    const centang = (kunci) => {
        const kotak = document.querySelector(`[data-tugas="${kunci}"]`);
        if (!kotak || kotak.checked) return;

        kotak.checked = true;
        kotak.closest('label').classList.add('animate-pop');

        const semua = [...document.querySelectorAll('[data-tugas]')];
        const selesai = semua.filter((k) => k.checked).length;
        if (progres) progres.textContent = `${selesai} dari ${semua.length} selesai`;
        if (selesai === semua.length) document.dispatchEvent(new CustomEvent('tugas:selesai'));
    };

    document.querySelectorAll('[data-orby-klik]').forEach((t) => t.addEventListener('click', () => centang('sapa')));
    document.querySelectorAll('[data-loker]').forEach((t) => t.addEventListener('click', () => centang('buka')));
    document.querySelectorAll('[data-toggle="simpan"]').forEach((t) => {
        t.addEventListener('click', () => {
            setTimeout(() => { if (t.getAttribute('aria-pressed') === 'true') centang('simpan'); }, 0);
        });
    });
});