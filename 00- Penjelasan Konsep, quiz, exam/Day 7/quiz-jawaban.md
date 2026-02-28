# Quiz & Jawaban: Day 7 (CRUD Update & Delete)

### Pertanyaan 1:

Apa yang akan terjadi jika kamu menjalankan perintah `DELETE FROM users;` tanpa menggunakan klausa `WHERE`?
**Jawaban:** Semua data (baris) di dalam tabel `users` akan terhapus secara permanen.

### Pertanyaan 2:

Kenapa kita biasanya menggunakan `GET` (seperti `edit.php?id=5`) untuk menuju halaman edit, bukan `POST`?
**Jawaban:** Karena kita hanya ingin **mengambil** data berdasarkan ID yang spesifik melalui URL. `GET` lebih mudah untuk navigasi antar halaman, sedangkan `POST` lebih cocok untuk **mengirim** data sensitif/besar ke server.

### Pertanyaan 3:

Apa gunanya perintah `header("Location: index.php"); exit;` setelah melakukan proses query?
**Jawaban:** Untuk mengarahkan user kembali ke halaman utama (Redirect) dan mencegah pengiriman ulang form jika user melakukan "Refresh" halaman (prinsip Post-Redirect-Get).

### Pertanyaan 4:

Dalam proses Update, kenapa kita tetap harus menggunakan `prepare()` dan `execute()`, padahal kita sudah tahu ID data yang mau diubah?
**Jawaban:** Tetap harus digunakan untuk mencegah **SQL Injection**. ID maupun data baru bisa saja dimanipulasi oleh user dengan kode berbahaya sebelum sampai ke database.
