# Penjelasan Day 1-4 (PHP Basic)

## Day 1 - PHP Dasar (variabel, if else, loop)

### Konsep 1

- **Variabel** dipakai untuk menyimpan data (`$nama`, `$umur`).
- **If/else** dipakai untuk pengambilan keputusan berdasarkan kondisi.
- **Loop** (`for`, `while`, `foreach`) dipakai untuk perulangan agar tidak menulis kode berulang.

### Best Practice 1

- Gunakan nama variabel yang jelas (`$totalHarga`, bukan `$a`).
- Pisahkan logika per blok kecil, jangan campur semua dalam satu bagian panjang.
- Hindari hardcode berulang; simpan nilai penting dalam variabel/konstanta.
- Selalu cek tipe/kondisi sebelum operasi logika penting.

## Day 2 - Function & Array (associative array, foreach)

### Konsep 2

- **Function** dipakai untuk membungkus logika agar bisa dipakai ulang.
- **Array** menyimpan banyak data dalam satu variabel.
- **Associative array** pakai key nama (`['nama' => 'Budi']`).
- **foreach** adalah loop paling cocok untuk array.

### Best Practice 2

- Buat function fokus satu tugas (single responsibility).
- Beri parameter dan return yang jelas.
- Gunakan `foreach` untuk baca array, jangan pakai index manual kalau tidak perlu.
- Untuk data kompleks, gunakan associative array agar lebih mudah dibaca.

## Day 3 - Form Handling di PHP ($\_POST, validasi input)

### Konsep 3

- Form HTML mengirim data ke server lewat `POST`.
- PHP menerima input dari `$_POST`.
- Input harus divalidasi sebelum diproses/disimpan.
- Jika error, tampilkan pesan; jika valid, lanjut proses.

### Best Practice 3

- Selalu cek request method: `$_SERVER['REQUEST_METHOD'] === 'POST'`.
- Ambil input secara aman: `trim($_POST['field'] ?? '')`.
- Validasi wajib isi + format (misal email/angka).
- Escape output: `htmlspecialchars()` untuk mencegah XSS.
- Jangan hanya mengandalkan validasi frontend.

## Day 4 - Session di PHP dan Login Sederhana

### Konsep 4

- **Session** menyimpan data user sementara di server (misal status login).
- Setelah login valid, set session (`$_SESSION['user_id']`, `$_SESSION['username']`).
- Halaman private (dashboard) harus cek session terlebih dahulu.
- Logout menghapus session dan mengembalikan user ke login.

### Best Practice 4

- Selalu panggil `session_start()` sebelum output HTML.
- Buat file guard/middleware sederhana (`auth_check.php`) untuk proteksi halaman.
- Gunakan redirect + `exit` setelah login/logout.
- Hindari menyimpan password plain text (untuk produksi: hash password).
- Setelah login, idealnya gunakan `session_regenerate_id(true)`.
