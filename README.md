<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Filament-4-FBBF24?style=for-the-badge&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTEyIDJMNCAyMGgyMEwxMiAyeiIgZmlsbD0id2hpdGUiLz48L3N2Zz4=&logoColor=white" alt="Filament 4">
  <img src="https://img.shields.io/badge/Vite-7-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7">
  <img src="https://img.shields.io/badge/MySQL-Aiven-00758F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL Aiven">
  <img src="https://img.shields.io/badge/Deploy-Vercel-000000?style=for-the-badge&logo=vercel&logoColor=white" alt="Vercel">
</p>

# 🏫 WebKelas — Portal Digital XI PPLG 2

**WebKelas** adalah platform web modern yang dirancang sebagai portal digital untuk Kelas **XI PPLG 2**. Aplikasi ini menampilkan profil kelas, data anggota, struktur organisasi, sistem nilai akademik, dan panel admin untuk pengelolaan data secara terpusat.

> *"Solidaritas Tanpa Batas, Koding Tanpa Henti."*

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🏠 **Dashboard Publik** | Landing page dengan hero banner, profil kelas, struktur organisasi, dan pengumuman |
| 👤 **Profil Siswa** | Setiap siswa memiliki halaman profil pribadi dengan biodata, foto, dan skill |
| 📊 **Data Nilai** | Siswa dapat melihat nilai per semester lengkap dengan grafik performa |
| 📢 **Pengumuman** | Sistem pengumuman kelas yang dikelola oleh admin/wali kelas |
| 🛡️ **Admin Panel** | Panel admin berbasis Filament untuk mengelola seluruh data |
| 🌗 **Dark / Light Mode** | Tema gelap dan terang yang konsisten di seluruh halaman |
| 📱 **Responsif** | Tampilan optimal di desktop, tablet, dan smartphone |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Admin Panel:** Filament 4
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Bundler:** Vite 7
- **Database:** MySQL (lokal via Laragon / cloud via Aiven)
- **Deployment:** Vercel (Serverless PHP)

---

## 🚀 Instalasi Lokal

### Kebutuhan Sistem
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL / MariaDB (disarankan Laragon)

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/your-username/webkelas.git
cd webkelas

# 2. Install dependensi PHP
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
# Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Jalankan migrasi & seeder
php artisan migrate:fresh --seed

# 7. Buat symlink storage
php artisan storage:link

# 8. Install dependensi frontend & build
npm install
npm run build

# 9. Jalankan server
php artisan serve
```

Buka **http://localhost:8000** di browser. 🎉

---

## 🔐 Akun Bawaan (Seeder)

| Role | Username | Password | Akses |
|------|----------|----------|-------|
| Admin | `admin` | `password` | Panel Admin (`/admin`) |
| Wali Kelas | `teacher` | `password` | Panel Admin (`/admin`) |
| Siswa (contoh) | `21676` | `galang123` | Dashboard + Profil + Nilai |

> Semua 36 akun siswa menggunakan format password: **nama_depan_kecil + 123** (contoh: `galang123`, `muhammad123`, `afriza123`)

---

## 📁 Struktur Direktori

```
webkelas/
├── app/
│   ├── Filament/          # Admin panel (Resources, Pages, Widgets)
│   ├── Http/Controllers/  # Dashboard, Profile, Grade controllers
│   ├── Models/            # User, Student, Grade, Subject, dll
│   └── Policies/          # Authorization policies
├── database/
│   ├── migrations/        # Skema tabel database
│   └── seeders/           # Data awal (36 siswa, admin, teacher)
├── resources/views/
│   ├── components/        # Navbar, Footer (reusable)
│   ├── dashboard.blade.php
│   ├── grades/            # Halaman nilai siswa
│   └── profile/           # Halaman profil & setup biodata
├── public/
│   ├── build/             # Compiled Vite assets
│   └── storage/           # Uploaded images (symlink)
├── api/
│   └── index.php          # Vercel serverless entry point
├── vercel.json            # Vercel deployment config
└── ca.pem                 # SSL cert untuk Aiven MySQL
```

---

## ☁️ Deployment (Vercel + Aiven)

### Prasyarat
- Akun [Vercel](https://vercel.com)
- Database MySQL di [Aiven](https://aiven.io) (free tier tersedia)

### Langkah Deploy

1. **Push ke GitHub** — Pastikan `public/build/` dan `public/storage/` sudah ter-commit
2. **Import di Vercel** — Hubungkan repository GitHub ke Vercel
3. **Set Environment Variables** — Masukkan variabel berikut di Vercel Dashboard:

| Variable | Nilai |
|----------|-------|
| `APP_NAME` | `WebKelas XI PPLG 2` |
| `APP_ENV` | `production` |
| `APP_KEY` | *(copy dari .env)* |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-domain.vercel.app` |
| `APP_LOCALE` | `id` |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | *(dari Aiven)* |
| `DB_PORT` | *(dari Aiven)* |
| `DB_DATABASE` | `defaultdb` |
| `DB_USERNAME` | `avnadmin` |
| `DB_PASSWORD` | *(dari Aiven)* |
| `SESSION_DRIVER` | `cookie` |
| `CACHE_STORE` | `array` |
| `QUEUE_CONNECTION` | `sync` |

4. **Deploy!** — Vercel otomatis build dan deploy

### Migrasi Database ke Aiven
Koneksi ke Aiven bisa melalui **HeidiSQL** (via Laragon):
1. Buka HeidiSQL → New Session
2. Masukkan Host, Port, Username, Password dari Aiven
3. Centang **"Use SSL"** dan arahkan CA file ke `ca.pem`
4. Jalankan migrasi: `php artisan migrate --force` (dengan `.env` yang sudah mengarah ke Aiven)

---

## 👥 Tim Pengembang

**Kelas XI PPLG 2** — SMKN 1 Purwokerto

---

## 📄 Lisensi

Project ini dikembangkan untuk keperluan internal kelas XI PPLG 2.
