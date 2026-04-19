# Sistem Peminjaman Buku Sederhana

Aplikasi ini merupakan sistem peminjaman buku berbasis web yang dibangun menggunakan Laravel. Proyek ini dirancang untuk memenuhi kebutuhan pengelolaan data buku dan anggota, serta proses pengajuan peminjaman buku oleh anggota.

Aplikasi memiliki dua jenis pengguna:
- Admin
- Anggota

## Tujuan Proyek

Proyek ini dibuat untuk mengimplementasikan aplikasi perpustakaan sederhana dengan fitur inti berikut:
- Pengelolaan master buku
- Pengelolaan data anggota
- Pengajuan peminjaman buku oleh anggota
- Monitoring daftar pengajuan peminjaman oleh admin
- Penyediaan API sederhana untuk data buku

## Fitur yang Diimplementasikan

### Fitur Admin
- Login sebagai admin
- CRUD master buku
- CRUD anggota
- Melihat daftar pengajuan peminjaman buku dari anggota

### Fitur Anggota
- Login sebagai anggota
- Mengajukan peminjaman buku
- Memilih buku yang ingin dipinjam
- Mengisi tanggal peminjaman dan tanggal pengembalian

### API Buku
API berikut tersedia dalam format JSON:
- `GET /api/books` mengambil seluruh data buku
- `GET /api/books/{code}` mengambil detail buku berdasarkan kode buku
- `POST /api/books` menambahkan buku baru
- `PUT /api/books/{code}` mengubah data buku berdasarkan kode buku
- `DELETE /api/books/{code}` menghapus data buku berdasarkan kode buku

## Ruang Lingkup Implementasi

Sesuai requirement, proyek ini hanya mengimplementasikan fitur yang termasuk dalam bagian prioritas, yaitu:
- CRUD master buku
- CRUD anggota
- Daftar pengajuan buku untuk admin
- Pengajuan peminjaman buku oleh anggota

Fitur approval, reject, dan pengembalian buku belum diaktifkan pada antarmuka aplikasi. Namun, struktur database untuk pengembangan fitur tersebut sudah disiapkan.

## Teknologi yang Digunakan
- PHP
- Laravel
- Eloquent ORM
- SQLite
- Blade Template Engine
- jQuery AJAX
- DataTables server-side
- AdminLTE

## Struktur Data Utama

Aplikasi ini menggunakan tabel utama berikut:
- `admins`
- `members`
- `books`
- `book_loans`

Dokumentasi rancangan database dan ERD dapat dilihat pada file berikut:
- [docs/ERD.md](docs/ERD.md)

## Cara Menjalankan Aplikasi

### Prasyarat
Pastikan perangkat sudah memiliki:
- PHP
- Composer

### Langkah Menjalankan
Jalankan perintah berikut dari folder project:

```bash
composer install
php artisan migrate:fresh --seed
php artisan serve
```

Setelah server berjalan, aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Akun Demo

### Admin
- Email: `admin@library.test`
- Password: `password`

### Anggota
- Email: `anggota@library.test`
- Password: `password`

## Panduan Penggunaan Singkat

### Alur Admin
1. Login melalui halaman admin.
2. Kelola data buku melalui menu `Master Buku`.
3. Kelola data anggota melalui menu `Anggota`.
4. Pantau daftar pengajuan pada menu `Pengajuan Buku`.

### Alur Anggota
1. Login melalui halaman anggota.
2. Buka menu `Ajukan Peminjaman`.
3. Pilih buku yang tersedia.
4. Isi tanggal peminjaman dan tanggal pengembalian.
5. Kirim pengajuan peminjaman.

## Pengujian

Pengujian dasar yang telah dijalankan mencakup:
- CRUD API buku
- Validasi kode buku unik
- Pengajuan peminjaman oleh anggota

Perintah pengujian:

```bash
php artisan test
```

## Catatan Tambahan

Proyek ini dikembangkan dengan pendekatan sederhana dan terstruktur agar mudah dibaca, dijalankan, dan dikembangkan lebih lanjut.

Fokus implementasi diarahkan pada pemenuhan requirement utama, penggunaan Eloquent ORM, multi-auth berbasis guard, tampilan admin template, serta integrasi DataTables server-side dan jQuery AJAX sesuai kebutuhan tugas.
