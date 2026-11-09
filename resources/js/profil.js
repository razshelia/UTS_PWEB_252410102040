// Edit profil simulasi: perubahan hanya di DOM dan hilang saat reload
const polaTeks = /^[\p{L}\p{N} _-]+$/u;

const aturan = {
    nama: { label: 'Nama', min: 2, max: 20, pola: polaTeks, pesan: 'Nama hanya boleh huruf, angka, spasi, strip, dan garis bawah.' },
    fase: { label: 'Fase', min: 1, max: 40, pola: null, pesan: '' },
    status: { label: 'Status', min: 2, max: 24, pola: polaTeks, pesan: 'Status hanya boleh huruf, angka, spasi, strip, dan garis bawah.' },
    bio: { label: 'Bio', min: 3, max: 50, pola: null, pesan: '' },
};

const rapikan = (teks) => teks.trim().replace(/\s+/g, ' ');

const mulai = () => {
    const form = document.querySelector('[data-form-profil]');
    if (!form) return;

    const tombolEdit = form.querySelector('[data-edit-profil]');
    const tombolSimpan = form.querySelector('[data-simpan-profil]');
    const tombolBatal = form.querySelector('[data-batal-profil]');
    const galat = form.querySelector('[data-galat-profil]');
    const info = form.querySelector('[data-info-profil]');

    if (!tombolEdit || !tombolSimpan || !tombolBatal) return;

    const bidang = Object.keys(aturan)
        .map((kunci) => ({
            kunci,
            tampil: form.querySelector(`[data-tampil="${kunci}"]`),
            input: form.querySelector(`[data-input="${kunci}"]`),
        }))
        .filter((b) => b.tampil && b.input);

    if (!bidang.length) return;

    const bidangNama = bidang.find((b) => b.kunci === 'nama');
    const bidangFase = bidang.find((b) => b.kunci === 'fase');

    let mengedit = false;
    let timerInfo;

    const atur = (edit) => {
        mengedit = edit;
        bidang.forEach((b) => {
            b.tampil.classList.toggle('hidden', edit);
            b.input.classList.toggle('hidden', !edit);
            if (edit) b.input.value = b.tampil.textContent.trim();
        });
        tombolEdit.classList.toggle('hidden', edit);
        tombolSimpan.classList.toggle('hidden', !edit);
        tombolBatal.classList.toggle('hidden', !edit);
        if (galat) {
            galat.classList.add('hidden');
            galat.textContent = '';
        }
        (edit ? bidang[0].input : tombolEdit).focus();
    };

    const periksa = () => {
        for (const b of bidang) {
            const nilai = rapikan(b.input.value);
            const a = aturan[b.kunci];
            let pesan = '';

            if (nilai.length < a.min) pesan = `${a.label} minimal ${a.min} karakter.`;
            else if (nilai.length > a.max) pesan = `${a.label} maksimal ${a.max} karakter.`;
            else if (a.pola && !a.pola.test(nilai)) pesan = a.pesan;

            if (pesan) return { pesan, input: b.input };
        }
        return null;
    };

    tombolEdit.addEventListener('click', () => {
        if (info) info.textContent = '';
        atur(true);
    });

    tombolBatal.addEventListener('click', () => atur(false));

    form.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mengedit) atur(false);
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!mengedit) return;

        const salah = periksa();
        if (salah) {
            if (galat) {
                galat.textContent = salah.pesan;
                galat.classList.remove('hidden');
            }
            salah.input.focus();
            return;
        }

        // Jeda singkat
        tombolSimpan.disabled = true;
        tombolSimpan.textContent = 'Menyimpan...';

        setTimeout(() => {
            bidang.forEach((b) => { b.tampil.textContent = rapikan(b.input.value); });

            const nama = bidangNama ? rapikan(bidangNama.input.value) : '';

            if (bidangNama) {
                document.querySelectorAll('[data-nama]').forEach((el) => { el.textContent = nama; });
            }

            if (bidangFase) {
                const opsi = bidangFase.input.selectedOptions[0];
                if (opsi) {
                    document.querySelectorAll('[data-fase]').forEach((el) => { el.textContent = opsi.value; });
                    document.querySelectorAll('[data-fase-singkat]').forEach((el) => { el.textContent = opsi.dataset.singkat; });
                    document.querySelectorAll('[data-aura]').forEach((el) => { el.textContent = opsi.dataset.aura; });
                }
            }

            tombolSimpan.disabled = false;
            tombolSimpan.textContent = 'Simpan';
            atur(false);

            if (info) {
                info.textContent = 'Profil diperbarui.';
                clearTimeout(timerInfo);
                timerInfo = setTimeout(() => { info.textContent = ''; }, 4000);
            }

            document.dispatchEvent(new CustomEvent('profil:diubah', { detail: { nama } }));
        }, 700);
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mulai);
} else {
    mulai();
}