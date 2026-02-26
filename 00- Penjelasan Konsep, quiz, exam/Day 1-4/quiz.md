# Quiz Day 1-4 (PHP Basic)

## Day 1 Quiz

1. Apa perbedaan `if`, `else if`, dan `else`?
2. Kapan kamu memilih `for` dibanding `while`?
3. Kenapa penamaan variabel yang jelas penting?
4. Apa output loop `for ($i = 1; $i <= 3; $i++)`?
5. Sebutkan satu contoh kondisi logika sederhana untuk validasi umur.

## Day 2 Quiz

1. Kenapa function membantu maintainability kode?
2. Apa bedanya indexed array dan associative array?
3. Kapan sebaiknya pakai `foreach`?
4. Apa keuntungan function yang punya return value?
5. Buat contoh associative array `siswa` dengan key `nama` dan `kelas`.

## Day 3 Quiz

1. Kenapa data sensitif sebaiknya dikirim lewat `POST`, bukan `GET`?
2. Apa fungsi `trim()` saat membaca `$_POST`?
3. Apa perbedaan `is_numeric()` dan `ctype_digit()`?
4. Kenapa `htmlspecialchars()` penting di output?
5. Kapan pesan "Input valid" seharusnya muncul?

## Day 4 Quiz

1. Apa fungsi `session_start()`?
2. Kenapa dashboard harus cek session login?
3. Apa efek jika `header('Location: ...')` dipakai tanpa `exit;`?
4. Bedanya `session_unset()` dan `session_destroy()` apa?
5. Kenapa middleware/guard manual (`auth_check.php`) membantu kerapian kode?

---

## Kunci Jawaban Singkat (Opsional)

- Day 3 no.4: untuk mencegah XSS saat menampilkan input user.
- Day 4 no.3: script masih bisa lanjut dieksekusi jika tanpa `exit;`.
- Day 4 no.2: agar halaman private tidak bisa diakses user yang belum login.
