# We Care

We Care adalah sebuah platform berbasis web yang memungkinkan pengguna untuk melakukan donasi secara online. Proyek ini dikembangkan menggunakan framework **Laravel** untuk backend dan **Bootstrap** untuk frontend. Proyek ini dirancang sebagai bagian dari mata kuliah Manajemen Proyek Perangkat Lunak.

## Fitur Utama
- **Manajemen Donasi**: Pengguna dapat memberikan donasi secara online.
- **Dashboard Admin**: Untuk memantau dan mengelola donasi yang masuk.
- **Riwayat Donasi**: Catatan lengkap donasi yang dilakukan oleh pengguna.
- **Responsif**: Desain antarmuka yang mendukung perangkat desktop dan mobile.

## Persyaratan Sistem
- **PHP** versi 8.1 atau lebih baru
- **Composer** versi terbaru
- **MySQL** atau database lain yang kompatibel
- **Laravel** versi 10.x

## Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/reynaldiarya/We-Care.git
cd We-Care
```

### 2. Instal Dependensi
Jalankan perintah berikut untuk menginstal semua dependensi backend:
```bash
composer install
```

### 3. Konfigurasi Lingkungan
Salin file `.env.example` menjadi `.env` dan atur konfigurasi yang sesuai:
```bash
cp .env.example .env
```
Edit file `.env` untuk mengatur:
- Database (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- App Key (`php artisan key:generate` untuk menghasilkan kunci aplikasi)

### 4. Migrasi Database
Jalankan migrasi untuk membuat tabel database:
```bash
php artisan migrate --seed
```

### 5. Jalankan Server Lokal
Gunakan perintah berikut untuk menjalankan server lokal:
```bash
php artisan serve
```
Akses aplikasi di: `http://localhost:8000`

## Lisensi
Proyek ini menggunakan lisensi [MIT](LICENSE).
