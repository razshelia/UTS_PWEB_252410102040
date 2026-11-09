# Loreberry 🍓🎀 - Proyek UTS Pemrograman Web

Loreberry adalah website *single page* bertema lorong loker pink bergaya Y2K soft dan coquette, dibangun menggunakan Laravel 13, Vite, dan Tailwind CSS. Proyek ini dibuat untuk memenuhi Ujian Tengah Semester (UTS) mata kuliah Pemrograman Web.

Di Loreberry, setiap loker menyimpan satu surat rahasia dari **Orby**, maskot campuran Chiikawa dan guinea pig. Isinya fakta ilmiah unik tentang buah, serangga, dan tumbuhan, lengkap dengan pesan yang disesuaikan dengan peran dan usia pengguna.

**Tema pengelolaan:** pengelolaan loker fakta (membuka, mencari, menyukai, dan menyimpan fakta).

Dibuat oleh: **[Nama Lengkap]** - NIM **252410102040**

## 📸 Tampilan

| Login | Dashboard |
|---|---|
| ![Login](docs/screenshots/login.png) | ![Dashboard](docs/screenshots/dashboard.png) |

| Lorong Loker (Pengelolaan) | Surat Rahasia (Pop-up) |
|---|---|
| ![Lorong Loker](docs/screenshots/loker.png) | ![Surat](docs/screenshots/surat.png) |

| Profil | Tampilan Mobile |
|---|---|
| ![Profil](docs/screenshots/profil.png) | ![Mobile](docs/screenshots/mobile.png) |

## ✨ Fitur Utama

* **Beranda Publik:** halaman pertama menampilkan website dan cara kerjanya. Lorong loker masih **terkunci** sampai pengunjung masuk atau daftar.
* **Daftar dan Login (simulasi):** akun disimpan di *session*, bukan database. Ada validasi form dan pesan error.
* **Dashboard:** menyapa pengguna lewat *request parameter* (`/home?username=...`), menampilkan aura harian, dan **Misi Hari Ini** yang tercentang otomatis saat dilakukan.
* **Pengelolaan (Lorong Loker):** 10 loker dari array di controller, ditampilkan dengan `@foreach` dan bisa digulir ke samping. Ada **pencarian**, pop-up surat yang keluar dari loker, serta tombol **Suka** dan **Simpan**.
* **Profil:** kartu identitas dengan fitur *fake edit* (nama, fase, status, dan bio diubah lewat JavaScript tanpa server).
* **Maskot Interaktif:** Orby miring mengikuti kursor, melompat saat diklik, dan ada Orby kecil yang mengikuti kursor dengan berbagai ekspresi.
* **Kejutan:** kartu hadiah dan konfeti muncul setelah semua misi selesai.
* **Desain Responsif dan SEO:** navbar bergaya *glassmorphism*, layout memakai Tailwind CSS dengan *hamburger menu* untuk layar kecil, struktur HTML semantik, serta meta tag untuk SEO.

## 🚀 Teknologi yang Digunakan

* **Backend:** [Laravel 13](https://laravel.com/)
* **Frontend:** [Tailwind CSS](https://tailwindcss.com/)
* **Build Tool:** [Vite](https://vitejs.dev/)
* **Templating:** Blade (termasuk Blade Components)
* **Core:** PHP, JavaScript (Vanilla JS, tanpa library tambahan)

## 🗂️ Struktur File Utama

| File | Fungsi |
|---|---|
| `routes/web.php` | Daftar route aplikasi |
| `app/Http/Controllers/PageController.php` | Menyimpan data array dan mengirimnya ke view |
| `app/Http/Controllers/AuthController.php` | Proses daftar, login, dan logout (session) |
| `resources/views/layouts/app.blade.php` | Layout utama (`@yield`) |
| `resources/views/landing.blade.php` | Beranda publik (loker terkunci) |
| `resources/views/login.blade.php` | Halaman login |
| `resources/views/register.blade.php` | Halaman daftar |
| `resources/views/home.blade.php` | Halaman utama (`@extends`, `@section`, `@include`) |
| `resources/views/dashboard.blade.php` | Bagian dashboard |
| `resources/views/pengelolaan.blade.php` | Bagian pengelolaan (lorong loker) |
| `resources/views/profile.blade.php` | Bagian profil |
| `resources/views/components/navbar.blade.php` | Komponen navbar |
| `resources/views/components/footer.blade.php` | Komponen footer |

Halaman `home` menyatukan dashboard, pengelolaan, dan profil menjadi satu halaman yang di-scroll. Masing-masing bagian dipisah menjadi file Blade sendiri lewat `@include`.

## 🔧 Instalasi dan Setup

Berikut adalah langkah-langkah untuk menjalankan proyek ini di komputer lokal.

1.  **Clone repositori:**
    ```bash
    git clone https://github.com/USERNAME_GITHUB/UTS_PWEB_252410102040.git
    ```

2.  **Masuk ke direktori proyek:**
    ```bash
    cd UTS_PWEB_252410102040
    ```

3.  **Install dependensi Composer:**
    ```bash
    composer install
    ```

4.  **Install dependensi NPM:**
    ```bash
    npm install
    ```

5.  **Salin file environment:**
    ```bash
    cp .env.example .env
    ```

6.  **Pastikan session memakai file (tanpa database).** Buka `.env`, lalu cek dua baris ini:
    ```env
    SESSION_DRIVER=file
    CACHE_STORE=file
    ```

7.  **Buat *Application Key*:**
    ```bash
    php artisan key:generate
    ```

8.  **Jalankan server pengembangan:**
    Buka **dua terminal**:

    * Di **Terminal 1**, jalankan Vite untuk kompilasi aset (CSS/JS):
        ```bash
        npm run dev
        ```

    * Di **Terminal 2**, jalankan server Laravel:
        ```bash
        php artisan serve
        ```

9.  **Buka aplikasi:**
    Buka `http://127.0.0.1:8000` di browser.

## 🔑 Cara Menggunakan

Kamu bisa **mendaftar** lewat halaman `/daftar` (isi username, usia, peran, dan password), atau memakai akun bawaan yang ada di `app/Http/Controllers/AuthController.php`:

| Username | Password | Peran | Usia |
|---|---|---|---|
| `sasa` | `sasa123` | Pelajar | 16 |
| `berry` | `berry123` | Mahasiswa | 21 |
| `kakak` | `kakak123` | Pekerja | 27 |

Dari beranda, klik **Masuk** atau **Daftar**. Setelah login, klik pintu loker untuk membuka suratnya. Pesan di dalam surat berbeda untuk setiap peran dan kelompok usia.

## 📝 Catatan

* Proyek ini **tidak memakai database**. Semua data berupa array statis di `PageController`, sedangkan akun yang didaftarkan disimpan sementara di *session*.
* Fitur edit profil hanya mengubah tampilan di browser dan akan kembali seperti semula saat halaman dimuat ulang.
* Font: Sweet Melody dan Papernotes. Ilustrasi dan aset gambar dibuat dengan bantuan AI generatif (Gemini).