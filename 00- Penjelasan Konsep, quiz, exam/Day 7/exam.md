# Exam Day 7: Full CRUD Mini Project

Hari ini adalah ujian untuk kemampuan database-mu. Kamu akan membuat aplikasi **Manajemen Produk Sederhana**.

## Tugas:

Buatlah sebuah sistem mini-CRUD dengan fitur:

1.  **Daftar Produk**: Menampilkan nama produk, harga, dan stok dalam tabel.
2.  **Tambah Produk**: Form untuk memasukkan produk baru.
3.  **Hapus Produk**: Tombol hapus di setiap baris tabel.
4.  **Edit Produk**: Tombol edit yang membawa user ke halaman formulir berisi data lama, lalu bisa disimpan kembali.

## Struktur Database:

Buat database `toko_kita` dengan tabel `produk`:

- `id` (INT, AI, PK)
- `nama_produk` (VARCHAR 100)
- `harga` (INT)
- `stok` (INT)

## Aturan Main:

- Gunakan **PDO** untuk koneksi.
- Gunakan **Prepared Statements** untuk semua query.
- Gunakan **Redirect** setelah sukses melakukan Insert/Update/Delete.
- Tampilkan pesan sukses menggunakan Session atau URL Parameter.

---

**Tips**: Pisahkan file `koneksi.php` agar bisa dipakai di banyak file (index, tambah, edit, hapus).
