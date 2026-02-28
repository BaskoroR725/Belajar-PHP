<?php
require_once 'koneksi.php';

/*  Tugas Day 6 Exam:
   - Menampilkan form input: Nama dan Pesan.
   - Di bawah form, tampilkan daftar guestbook.
 */

$nama = '';
$pesan = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $pesan = trim($_POST['pesan'] ?? '');

  if ($nama === '' || $pesan === '') {
    $error = 'Nama dan pesan wajib diisi.';
  } else {
    // waktu_kirim tidak perlu di-insert manual karena sudah ada DEFAULT CURRENT_TIMESTAMP di database
    $insertSql = 'INSERT INTO tamu (nama, pesan) VALUES (:nama, :pesan)';
    $stmt = $pdo->prepare($insertSql);

    try {
      $stmt->execute([
        ':nama' => $nama,
        ':pesan' => $pesan
      ]);
      $success = 'Pesan berhasil dikirim!';
      $nama = '';
      $pesan = '';
    } catch (PDOException $e) {
      $error = 'Gagal menyimpan data: ' . $e->getMessage();
    }
  }
}

$rows = [];
try {
  $rows = $pdo->query('SELECT id, nama, pesan, waktu_kirim FROM tamu ORDER BY id DESC')->fetchAll();
} catch (PDOException $e) {
  $error = "Terjadi kesalahan saat mengambil data.";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guestbook - Day 6 Exam</title>
  <style>
    body {
      font-family: sans-serif;
      line-height: 1.6;
      padding: 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }

    form {
      background: #f4f4f4;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 30px;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      background: #333;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h1>📖 Buku Tamu (Day 6 Exam)</h1>

  <?php if ($error !== ''): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <?php if ($success !== ''): ?>
    <p class="success"><?= htmlspecialchars($success) ?></p>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" required>

    <label for="pesan">Pesan:</label>
    <textarea id="pesan" name="pesan" rows="4" required><?= htmlspecialchars($pesan) ?></textarea>

    <button type="submit">Kirim Pesan</button>
  </form>

  <h2>Daftar Pesan</h2>

  <?php if (empty($rows)): ?>
    <p>Belum ada tamu yang mengisi pesan.</p>
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