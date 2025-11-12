# Portofolio Pribadi & Dashboard Admin (Berbasis Laravel)

Ini adalah proyek portofolio pribadi full-stack yang dibangun menggunakan framework Laravel. Proyek ini menampilkan halaman portofolio publik (depan) dan dashboard admin (backend) yang dilindungi untuk mengelola seluruh konten website.

![Screenshot Halaman Depan](https://drive.google.com/file/d/15r4dADQ2EobC1uAFCxSFe-Xc4fqFvEKI/view?usp=sharing)

---

## ✨ Fitur Utama

### Halaman Depan (Portofolio)
* Desain single-page yang bersih dan responsif.
* *Projects Grid:* Tampilan 3 kolom untuk proyek dengan fitur *"Load More"* (memuat 6 proyek awal, lalu 3 per klik).
* *Modal Carousel:* Detail proyek muncul dalam modal (pop-up) dengan carousel Bootstrap (navigasi titik & panah) untuk galeri gambar.
* *Dinamis:* Semua konten (About, Experience, Education, Projects, Skills, Certificates) diambil langsung dari database.
* *Anti-Crash:* Halaman akan menampilkan placeholder jika data (seperti About/Certificates) masih kosong di database.

### Dashboard Admin
* *Autentikasi Aman:* Login menggunakan Google (Laravel Socialite).
* *CRUD Lengkap:* Manajemen penuh (Create, Read, Update, Delete) untuk semua bagian:
    * Halaman (About, Interests, Certificates)
    * Experience
    * Education
    * Projects
* *Editor Teks Canggih:* Menggunakan *Summernote* untuk membuat deskripsi (About, Project, dll) yang mendukung format rich text dan link.
* *Upload Gambar Modern:*
    * Menggunakan *Dropzone.js* untuk drag-and-drop upload gambar.
    * Fitur upload multi-gambar (banyak gambar sekaligus).
    * Upload asynchronous (live) ke folder temp_uploads untuk mencegah file sampah.
* *Manajemen Galeri:*
    * Di halaman "Edit Project", dapat melihat semua gambar yang sudah di-upload.
    * Hapus gambar satu per satu (via tombol "X") menggunakan fetch (AJAX) tanpa me-refresh halaman.
    * Hapus file dari server (bukan hanya dari database) untuk menghemat penyimpanan.

---

## 💻 Teknologi yang Digunakan

* *Backend:* PHP (v8.x), Laravel (v10/v11)
* *Frontend:* Bootstrap 4 (Admin), Bootstrap 5 (Depan), JavaScript (ES6+), CSS3
* *Database:* MySQL
* *Library:*
    * Laravel Socialite (Google Login)
    * Dropzone.js (Drag & Drop Upload)
    * Summernote (Rich Text Editor)
    * Material Design Icons (MDI)

---

## Demo Live

Anda dapat melihat versi live dari proyek ini di sini:
*[LINK_DEMO_LIVE_HOSTING_KAMU]*

---

## 🖼 Galeri Screenshot

| Halaman Depan (Grid) | Modal Detail Project |
| :---: | :---: |
| ![Screenshot Grid Project](LINK_KE_SCREENSHOT_GRID) | ![Screenshot Modal](https://drive.google.com/file/d/1nczC3D919FpCan22a0m2bRkIfsjkN1Qz/view?usp=sharing) |

| Dashboard: Edit Project (Fitur Utama) | Dashboard: Index Project |
| :---: | :---: |
| ![Screenshot Dashboard Edit](LINK_KE_SCREENSHOT_EDIT) | ![Screenshot Dashboard Index](LINK_KE_SCREENSHOT_INDEX) |

---

## 🚀 Cara Instalasi & Menjalankan (Lokal)

1.  Clone repositori ini:
    bash
    git clone [https://github.com/](https://github.com/)[USERNAME_MU]/[NAMA_REPO_MU].git
    
2.  Masuk ke direktori proyek:
    bash
    cd [NAMA_REPO_MU]
    
3.  Install dependensi composer:
    bash
    composer install
    
4.  Salin file .env.example menjadi .env:
    bash
    cp .env.example .env
    
5.  Buat app key baru:
    bash
    php artisan key:generate
    
6.  Buka file .env dan atur koneksi database kamu (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
7.  Atur juga kredensial Google Socialite kamu (GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET) di .env.
8.  Jalankan migrasi database:
    bash
    php artisan migrate
    
9.  Jalankan server lokal:
    bash
    php artisan serve
    
10. Buka http://127.0.0.1:8000 di browser-mu.
