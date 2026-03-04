<?php
require_once 'connection.php';

$nama = '';
$pesan = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $pesan = trim($_POST['pesan'] ?? '');

  if ($nama === '' || $pesan === '') {
    $error = 'Mohon nama dan pesan diisi. WAJIB.';
  } else {
    $insertsql = 'INSERT INTO tamu (nama, pesan) VALUES(:nama, :pesan)';
    $stmt = $pdo->prepare($insertsql);

    try {
      $stmt->execute([
        'nama'  => $nama,
        'pesan' => $pesan
      ]);
      $success = 'Data berhasil disimpan';
      $nama = '';
      $pesan = '';
    } catch (PDOException $e) {
      $error = "Gagal memasukkan data" . $e->getMessage();
    }
  }
}

$rows = [];

try {
  $rows = $pdo->query('SELECT id,nama,pesan,waktu_kirim FROM tamu ORDER BY id DESC')->fetchAll();
} catch (PDOException $e) {
  $error = 'Gagal ambil data' . $e->getMessage();
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
  <?php if ($error !== ''): ?>
    <p style='color:red;'><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <?php if ($success !== ''): ?>
    <p style='color:green;'><?= htmlspecialchars($success) ?></p>
  <?php endif; ?>
  <form action="" method="post">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value='<?= htmlspecialchars($nama) ?>' required>
    <label for="pesan">Pesan</label>
    <textarea name="pesan" id="pesan" required><?= htmlspecialchars($pesan) ?></textarea>
    <button type="submit">Kirim</button>
  </form>

  <h2>Daftar Tamu</h2>
  <?php if (empty($rows)): ?>
    <p>Belum ada pesan</p>
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