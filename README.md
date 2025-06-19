

# 🚀 LaraFila-starterkit-12 -> MultiTenant-Shield

Laravel 12 Starter Kit adalah proyek Laravel yang dirancang untuk memudahkan Anda memulai pengembangan aplikasi web dengan Laravel 12. Proyek ini menyediakan struktur dasar yang memungkinkan Anda dengan cepat membuat aplikasi web yang responsif dan nyaman digunakan. Menggunakan


1.  📥 Clone repositori ini:
    ```bash
    git clone https://github.com/doniaries/laravel12starterkit.git
    cd laravel12starterkit
    ```
2.  📄 Salin berkas `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
3.  📦 Instal dependensi PHP menggunakan Composer:
    ```bash
    composer install
    ```
4.  🔑 Buat kunci aplikasi:
    ```bash
    php artisan key:generate
    ```
5.  ⚙️ Konfigurasikan detail database Anda di berkas `.env`.
6.  💾 Jalankan migrasi database:
    ```bash
    php artisan migrate
    ```
7.  💻 Instal dependensi Node.js:
    ```bash
    npm install
    ```
8.  🚀 Jalankan server pengembangan:
    ```bash
    npm run dev
    ```
    Dan di terminal lain:
    ```bash
    php artisan serve
    ```

## 🎨 Dependensi Frontend (Plugins)

Proyek ini menggunakan Vite untuk kompilasi aset frontend. Berikut adalah dependensi utama yang digunakan:

*   ✨ **@tailwindcss/vite**: Integrasi Tailwind CSS dengan Vite.
*   🌐 **axios**: Klien HTTP berbasis Promise untuk browser dan Node.js.
*   🔄 **concurrently**: Menjalankan beberapa perintah secara bersamaan.
*   🧩 **laravel-vite-plugin**: Integrasi Vite resmi untuk Laravel.
*   🎨 **tailwindcss**: Framework CSS utility-first.
*   ⚡ **vite**: Alat build frontend generasi berikutnya.

## 🔌 Dependensi Backend (Filament Plugins) - laravel12starterkit

Proyek ini menggunakan Filament sebagai admin panel. Berikut adalah plugin Filament utama yang digunakan:

*   🛡️ **bezhansalleh/filament-shield**: Manajemen peran dan izin untuk Filament.
*   🏗️ **filament/filament**: Framework inti Filament.
*   🎨 **hasnayeen/themes**: Plugin tema untuk Filament.
*   🎭 **stechstudio/filament-impersonate**: Fitur impersonasi pengguna untuk Filament.
*   🖼️ **swisnl/filament-backgrounds**: Mengatur gambar latar belakang untuk halaman login Filament.

## 🎓 Belajar Laravel

Laravel memiliki [dokumentasi](https://laravel.com/docs) dan pustaka tutorial video terlengkap dari semua kerangka kerja aplikasi web modern, membuatnya mudah untuk memulai dengan kerangka kerja ini.

Anda juga dapat mencoba [Laravel Bootcamp](https://bootcamp.laravel.com), di mana Anda akan dipandu membangun aplikasi Laravel modern dari awal.

Jika Anda tidak ingin membaca, [Laracasts](https://laracasts.com) dapat membantu. Laracasts berisi ribuan tutorial video tentang berbagai topik termasuk Laravel, PHP modern, pengujian unit, dan JavaScript. Tingkatkan keahlian Anda dengan menggali pustaka video komprehensif kami.

## ❤️ Sponsor Laravel

Kami ingin mengucapkan terima kasih kepada sponsor berikut yang mendanai pengembangan Laravel. Jika Anda tertarik untuk menjadi sponsor, silakan kunjungi [program Mitra Laravel](https://partners.laravel.com).


##🤝 Berkontribusi

Terima kasih telah mempertimbangkan untuk berkontribusi pada kerangka kerja Laravel! Panduan kontribusi dapat ditemukan di [dokumentasi Laravel](https://laravel.com/docs/contributions).

## 📜 Kode Etik

Untuk memastikan bahwa komunitas Laravel ramah bagi semua orang, harap tinjau dan patuhi [Kode Etik](https://laravel.com/docs/contributions#code-of-conduct).



## 📄 Lisensi

Kerangka kerja Laravel adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [lisensi MIT](https://opensource.org/licenses/MIT).
