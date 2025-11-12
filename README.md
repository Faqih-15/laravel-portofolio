# Portofolio Pribadi & Dashboard Admin (Berbasis Laravel)

Ini adalah proyek portofolio pribadi full-stack yang dibangun menggunakan framework Laravel. Proyek ini menampilkan halaman portofolio publik (depan) dan dashboard admin (backend) yang dilindungi untuk mengelola seluruh konten website.

![Screenshot Halaman Depan](https://drive.google.com/file/d/1nczC3D919FpCan22a0m2bRkIfsjkN1Qz/view?usp=sharing)

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
| ![Screenshot Grid Project](LINK_KE_SCREENSHOT_GRID) | ![Screenshot Modal](LINK_KE_SCREENSHOT_MODAL) |

| Dashboard: Edit Project (Fitur Utama) | Dashboard: Index Project |
| :---: | :---: |
| ![Screenshot Dashboard Edit](LINK_KE_SCREENSHOT_EDIT) | ![Screenshot Dashboard Index](LINK_KE_SCREENSHOT_INDEX) |

---

## 🚀 Cara Instalasi & Menjalankan (Lokal)

Silahkan **fork** dulu project ini di **REPOSITORY yang kalian punya** 
Clone project dari repo yang kalian punya

```
git clone https://github.com/{username github teman-teman}/laravel-portfolio-project.git
cd laravel-portfolio-project
```

Jalan terminal dengan perintah:

```
composer install && composer update
```

Lanjut copy file <code>.env.example</code> dengan nama <code>.env</code>. Kemudian edit beberapa di file berikut ini:

Terkait database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xxx
DB_USERNAME=xxx
DB_PASSWORD=xxx
```

Tambahkan script di bagian bawah file <code>.env</code>,

```
GOOGLE_CLIENT_ID="xxx"
GOOGLE_CLIENT_SECRET="xxx"
GOOGLE_CALLBACK="http://127.0.0.1:8000/auth/callback"
```

Petunjuk untuk mendapatkan Google Client Id, Google Client Secret dan pengaturan Google Callback, [buka link ini](https://console.cloud.google.com/apis/credentials)

Lanjut lakukan proses migrate melalui terminal

```
php artisan migrate
```

Lanjut, generate key

```
php artisan key:generate
```

Jalankan project dengan perintah

```
php artisan serve
```

Silakan dibuka di <code>http://127.0.0.1:8000</code>
