<p align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" width="200" alt="Laravel Logo">
</p>

<h2 align="center">📬 Manajemen Persuratan UMP </h2>

<p align="center">
  Aplikasi manajemen surat berbasis web yang dibangun dengan Laravel dan MySQL. Mendukung pencatatan surat masuk/keluar, log aktivitas, dan pengelolaan akun.
</p>


---

## 🚀 Fitur Utama
- dashboard
- Manajemen surat masuk & keluar
- Log aktivitas surat oleh pengguna
- Pengaturan akun dan keamanan
- Hak akses berdasarkan peran
- CRUD surat dengan validasi & notifikasi
- Tampilan bersih berbasis Bootstrap 
---

## 📦 Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Database**: MySQL
- **Frontend**: Blade, Bootstrap
- **Authentication**: Laravel Auth 

---

## ⚙️ Cara Instalasi

```bash
# Clone repo
git clone https://github.com/raahmajourney/manajemen-surat.git
cd nama-repo

# Install dependencies
composer install
npm install && npm run dev

# Copy dan atur file environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env
# Jalankan migrasi
php artisan migrate

# (Opsional) seed data awal
php artisan db:seed
