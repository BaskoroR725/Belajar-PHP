<!-- 1. Buat database baru bernama `db_latihan` dan tabel `tamu`:
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

_Selamat mengerjakan! Fokus pada alur kirim data -> simpan -> tampilkan._ -->
<?php
require_once 'koneksi.php';

$nama = '';
$pesan = '';
$error = '';
$success = '';

//pakai server method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   //trim nama dan pesan
   $nama = trim($_POST['nama'] ?? '');
   $pesan = trim($_POST['pesan'] ?? '');

   //validasi wajib diisi
   if ($nama === '' || $pesan === '') {
      $error = 'nama dan pesan wajib diisi';
   } else {
      //insert ke database pakai try catch
      $insertSql = 'INSERT INTO tamu (nama, pesan) VALUES (:nama, :pesan)';
      $stmt = $pdo->prepare($insertSql);

      try {
         $stmt->execute([
            ':nama' => $nama,
            ':pesan' => $pesan
         ]);
         $success = 'Data berhasil disimpan';
         $nama = '';
         $pesan = '';
      } catch (PDOException $e) {
         $error = "Gagal menyimpan data" . $e->getMessage();
      }
   }
}
//buat variabel menimpan data
$row_data = [];
//query semua data di urutkan yang terbaru juga pakai try catch
try {
   $row_data = $pdo->query('SELECT id,nama,pesan,waktu_kirim FROM tamu ORDER BY id DESC')->fetchAll();
} catch (PDOException $e) {
   $error = 'Terjadi kesalahan dalam mengambil data';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <h1>Buku Tamu</h1>
   <?php if ($error === '') : ?>
      <p style='color: red;'><?= htmlspecialchars($error) ?></p>
   <?php endif; ?>
   <?php if ($success === '') : ?>
      <p style='color: green;'><?= htmlspecialchars($success) ?></p>
   <?php endif; ?>

   <form action="" method="post">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" value='<?= htmlspecialchars($nama) ?>' required>
      <label for="pesan">Pesan</label>
      <textarea name="pesan" id="pesan" cols="30" rows="10" required><?= htmlspecialchars($pesan) ?></textarea>
      <button type="submit">Kirim</button>
   </form>

   <h2>Daftar Pesan</h2>
   <?php if (empty($rows)): ?>
      <p>Belum ada pesan.</p>
   <?php else: ?>
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Waktu</th>
               <th>Nama</th>
               <th>Pesan</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($rows as $row): ?>
               <tr>
                  <td><?= htmlspecialchars((string)$row['id']) ?></td>
                  <td><?= date('d/m/Y H:i', strtotime($row['waktu_kirim'])) ?></td>
                  <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                  <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   <?php endif; ?>
</body>

</html>