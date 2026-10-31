# GIS Fasilitas Kesehatan

Aplikasi web GIS untuk melihat dan mengelola informasi fasilitas kesehatan (faskes) berdasarkan lokasi administratif. Pengunjung dapat melihat persebaran faskes pada peta, sedangkan pengelola dapat memperbarui data melalui panel admin.

## Fitur

- Menampilkan peta wilayah dan lokasi fasilitas kesehatan.
- Menampilkan informasi faskes, seperti nama, jenis, status, akreditasi, alamat, foto, dan koordinat.
- Mengelola data faskes, wilayah, kategori, pengaturan situs, dan akun melalui panel admin.
- Pendaftaran akun dengan persetujuan admin, serta fitur lupa dan reset kata sandi.
- Menyediakan API JSON untuk data faskes, peta, wilayah, kategori, statistik, dan feedback.

## Teknologi

- PHP 8.2 atau lebih baru
- CodeIgniter 4
- PostgreSQL sebagai database utama
- Composer untuk mengelola dependensi PHP

## Menjalankan aplikasi

1. Pastikan PHP, Composer, dan PostgreSQL telah terpasang. Aktifkan ekstensi PHP `intl`, `mbstring`, dan `pgsql`.
2. Pasang dependensi dari direktori proyek:

   ```text
   composer install
   ```

3. Buat database PostgreSQL. Nama database harus sama dengan nilai `database.default.database` di file `.env`. Secara default proyek menggunakan `gisfaskespg`:

   ```text
   psql -U postgres -d postgres -c "CREATE DATABASE gisfaskespg;"
   ```

4. Sesuaikan koneksi PostgreSQL pada `.env` lokal:

   ```ini
   database.default.hostname = 127.0.0.1
   database.default.username = postgres
   database.default.password = password_postgresql_anda
   database.default.database = gisfaskespg
   database.default.DBDriver = Postgre
   database.default.port = 5432
   ```

5. Buat tabel dan jalankan migration:

   ```text
   psql -U postgres -d gisfaskespg -f db-gis-faskes-postgresql.sql
   php spark migrate
   ```

6. Jalankan server pengembangan:

   ```text
   php spark serve
   ```

   Buka alamat yang ditampilkan oleh perintah tersebut. Untuk Laragon atau web server lain, arahkan document root ke folder `public`.

## Impor data MySQL lama (opsional)

MySQL hanya diperlukan jika ingin menyalin data lama ke PostgreSQL. Atur koneksi `database.migrationSource.*` di `.env`, pastikan database PostgreSQL tujuan sudah memiliki struktur tabel dan masih kosong, lalu jalankan:

```text
php spark db:import-mysql
```

Perintah ini hanya untuk impor; aplikasi menggunakan koneksi `database.default` untuk operasi normal.

## API

Endpoint baca mengembalikan JSON dan tersedia dengan prefix `/api`, misalnya:

- `GET /api/faskes` — daftar faskes; dapat difilter dengan `jenis`, `status`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, atau pencarian `q`.
- `GET /api/faskes/map` — lokasi faskes dalam format GeoJSON.
- `GET /api/faskes/{id}` — detail satu faskes.
- `GET /api/wilayah` dan `GET /api/wilayah/{id}` — data wilayah.
- `GET /api/kategori` — daftar kategori.
- `GET /api/statistik` — statistik aplikasi.

Endpoint untuk membuat, memperbarui, atau menghapus data memerlukan autentikasi API.

## Keamanan dan kerja kelompok

- Jangan commit atau membagikan `.env` yang berisi password database, kredensial SMTP, atau rahasia lainnya.
- Bagikan file skema dan migration melalui Git agar setiap anggota dapat membuat database lokal dengan struktur yang sama.
- Jangan memasukkan kredensial nyata atau data pribadi ke dalam dump database yang dibagikan.
- Jika menggunakan database bersama, batasi akses pengguna dan siapkan backup berkala.