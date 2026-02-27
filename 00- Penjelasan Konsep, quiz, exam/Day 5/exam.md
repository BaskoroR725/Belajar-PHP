# Exam Day 5: Upload Foto Profil

**Tujuan:** Membuat halaman yang memungkinkan user mengupload foto profil dan langsung menampilkannya.

### Instruksi:

1. Buat folder `day5-latihan`.
2. Di dalamnya buat folder `uploads` (pastikan folder ini ada).
3. Buat file `index.php` yang berisi:
   - Form upload file.
   - Logika PHP untuk memproses upload.
4. **Validasi yang harus ada:**
   - File harus berupa gambar (`jpg`, `jpeg`, atau `png`).
   - Ukuran maksimal file adalah **500 KB**.
   - Jika berhasil, ubah nama file menjadi format: `profil_[timestamp].[ext]`.
5. **Output:**
   - Jika berhasil, tampilkan gambar yang baru saja diupload di halaman `index.php` tersebut.
   - Jika gagal, tampilkan pesan error yang jelas (cth: "File terlalu besar" atau "Hanya boleh gambar").

---

_Tips: Gunakan `pathinfo($filename, PATHINFO_EXTENSION)` untuk mendapatkan ekstensi file._
