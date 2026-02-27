# Kunci Jawaban Quiz Day 5

1. **Atribut wajib di tag `<form>`:**
   - `enctype="multipart/form-data"`.

2. **5 Informasi di `$_FILES`:**
   - `name`: Nama asli file.
   - `full_path`: Path lengkap (PHP 8.1+).
   - `type`: MIME type file.
   - `tmp_name`: Lokasi penyimpanan sementara.
   - `error`: Kode status upload.
   - `size`: Ukuran file dalam bytes.

3. **Fungsi `move_uploaded_file()`:**
   - Untuk memindahkan file dari folder sementara (temporary) server ke folder tujuan akhir di dalam project kita.

4. **Mengapa tidak pakai nama asli?**
   - **Mencegah duplikasi**: Jika 2 user upload file dengan nama sama, file lama akan tertimpa.
   - **Karakter aneh**: Nama file user mungkin mengandung spasi atau karakter unik yang bisa merusak path.
   - **Keamanan**: Menghindari eksekusi script jahat jika nama file mengandung pola tertentu.

5. **Membatasi 1MB:**
   - Cek `$_FILES['file']['size'] < 1048576` (karena 1024 \* 1024 bytes).
