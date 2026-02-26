# Quiz Jawaban Day 1-4 (PHP Basic)

## Day 1 - Jawaban

1. `if` untuk kondisi pertama, `else if` untuk kondisi tambahan, `else` untuk fallback jika semua kondisi sebelumnya false.
2. Pakai `for` jika jumlah iterasi sudah jelas; pakai `while` jika berhenti berdasarkan kondisi dinamis.
3. Agar kode mudah dibaca, mudah di-maintain, dan mengurangi bug karena salah paham konteks.
4. Output: `1`, `2`, `3` (tergantung format echo yang dipakai).
5. Contoh: `if ($umur < 17) { echo "Belum cukup umur"; } else { echo "Cukup umur"; }`

## Day 2 - Jawaban

1. Karena function membuat kode reusable, lebih rapi, dan mudah dites.
2. Indexed array pakai index angka (`0,1,2`), associative array pakai key bernama (`nama`, `kelas`).
3. Saat membaca/loop array, terutama associative array atau saat tidak butuh index manual.
4. Return value membuat hasil function bisa dipakai ulang di proses lain.
5. Contoh:

```php
$siswa = [
    'nama' => 'Budi',
    'kelas' => '10A'
];
```

## Day 3 - Jawaban

1. Karena `GET` menaruh data di URL, sedangkan `POST` lebih aman untuk data sensitif dan perubahan data.
2. Menghapus spasi di awal/akhir input agar validasi lebih akurat.
3. `is_numeric()` menerima format numerik luas (termasuk desimal), `ctype_digit()` hanya digit bulat positif dalam string.
4. Untuk mencegah XSS saat menampilkan input user ke HTML.
5. Saat request adalah `POST` dan array error kosong.

## Day 4 - Jawaban

1. Memulai/mengakses session agar `$_SESSION` bisa dipakai.
2. Agar halaman private tidak diakses user yang belum login.
3. Script bisa tetap lanjut jalan setelah redirect jika tanpa `exit;`.
4. `session_unset()` mengosongkan variabel session, `session_destroy()` menghapus session di server.
5. Karena logic proteksi jadi terpusat, konsisten, dan tidak duplikasi di banyak file.
