# Day 5: Upload File di PHP

Setelah belajar Session untuk login, hari ini kita akan belajar cara menerima input berupa file (gambar, dokumen, dll) dari user.

## 1. Persiapan Form (HTML)

Untuk mengirim file, tag `<form>` **WAJIB** memiliki atribut `enctype="multipart/form-data"`. Tanpa ini, file tidak akan terkirim.

```html
<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="gambar" />
  <button type="submit">Upload</button>
</form>
```

## 2. Mengenal variabel `$_FILES`

PHP menyimpan informasi file yang diupload ke variabel superglobal `$_FILES`.
Jika nama input adalah `gambar`, maka isinya:

- `$_FILES['gambar']['name']`: Nama asli file (cth: `foto.jpg`).
- `$_FILES['gambar']['type']`: Tipe file (cth: `image/jpeg`).
- `$_FILES['gambar']['tmp_name']`: Alamat sementara file di server.
- `$_FILES['gambar']['error']`: Kode error (0 jika berhasil).
- `$_FILES['gambar']['size']`: Ukuran file dalam bytes.

## 3. Langkah-langkah Upload yang Aman

1. **Cek Error**: Pastikan `error` bernilai `0`.
2. **Validasi Ekstensi**: Pastikan hanya file tertentu (cth: `.jpg`, `.png`) yang boleh diupload.
3. **Validasi Ukuran**: Jangan biarkan user upload file terlalu besar (cth: maks 2MB).
4. **Pindahkan File**: Pindahkan dari `tmp_name` ke folder tujuan menggunakan `move_uploaded_file()`.

```php
if ($_FILES['gambar']['error'] === 0) {
    if ($_FILES['gambar']['size'] < 2000000) { // 2MB
        $namaBaru = uniqid() . '-' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $namaBaru);
        echo "Upload Berhasil!";
    }
}
```

## 4. Keamanan (Penting!)

- Jangan pernah percaya nama asli file dari user. Selalu gunakan `uniqid()` atau rename file.
- Pastikan folder tujuan (`uploads/`) sudah dibuat dan punya izin tulis (_write permission_).
