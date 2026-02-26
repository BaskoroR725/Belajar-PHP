# Mini Exam PHP Basic (Day 1-4)

Durasi: **20 menit**  
Aturan: **tanpa lihat catatan/jawaban**

## Bagian A - Konsep (4 soal)

1. Jelaskan perbedaan `if`, `else if`, dan `else` dalam 2-3 kalimat.
2. Kapan kamu memilih `foreach` dibanding `for`?
3. Kenapa validasi backend tetap wajib meskipun sudah ada validasi di frontend?
4. Jelaskan fungsi `session_start()` pada alur login sederhana.

## Bagian B - Debugging (4 soal)

5. Temukan bug dan perbaiki:

```php
if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    echo 'Form dikirim';
}
```

6. Temukan bug dan perbaiki:

```php
$umur = trim($_POST['umur'] ?? '');
if (is_number($umur) && $umur >= 10) {
    echo 'Valid';
}
```

7. Kenapa kode berikut berbahaya? Perbaiki:

```php
echo $_POST['nama'];
```

8. Pada kode login, setelah `header('Location: dashboard.php');` kenapa sebaiknya tambahkan `exit;`?

## Bagian C - Praktik Singkat (2 soal)

9. Tulis potongan kode validasi untuk:

- `nama` wajib isi
- `email` wajib isi + format valid
- `pesan` opsional, tapi jika diisi minimal 10 karakter

10. Tulis potongan kode proteksi halaman `dashboard.php` menggunakan session login sederhana.

---

## Rubrik Penilaian (Self-check)

- Soal 1-4: masing-masing 10 poin (total 40)
- Soal 5-8: masing-masing 10 poin (total 40)
- Soal 9-10: masing-masing 10 poin (total 20)

Nilai akhir:

- 85-100: Siap lanjut materi lanjutan
- 70-84: Sudah paham dasar, perlu sedikit penguatan
- <70: Ulang review Day 1-4 dan latihan lagi
