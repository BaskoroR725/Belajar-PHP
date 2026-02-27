# Exam Day 6: Aplikasi "Buku Tamu" Sederhana

**Tujuan:** Membuat aplikasi PHP yang bisa menyimpan data pengunjung ke database MySQL.

### Instruksi:

1. Buat database baru bernama `db_latihan` dan tabel `tamu`:
   - `id` (INT, Primary Key, Auto Increment)
   - `nama` (VARCHAR 50)
   - `pesan` (TEXT)
   - `waktu_kirim` (DATETIME, default CURRENT_TIMESTAMP)

2. Buat file `koneksi.php` yang berisi konfigurasi PDO.

3. Buat file `index.php`:
   - Menampilkan form input: Nama dan Pesan.
   - Di bawah form, tampilkan daftar tamu yang sudah mengisi pesan (diambil dari database).

4. **Kriteria Penilaian:**
   - [ ] Berhasil terkoneksi ke database.
   - [ ] Data yang diinput melalui form masuk ke tabel `tamu` (Create).
   - [ ] Data dari tabel muncul di halaman web (Read).
   - [ ] Menggunakan Prepared Statements untuk keamanan.
   - [ ] Layout rapi (boleh pakai sedikit CSS).

---

_Selamat mengerjakan! Fokus pada alur kirim data -> simpan -> tampilkan._
