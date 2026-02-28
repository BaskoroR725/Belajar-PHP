<?php
require_once 'koneksi.php';

$nama = '';
$email = '';
$umur = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $umur = trim($_POST['umur'] ?? '');

    if ($nama === '' || $email === '' || $umur === '') {
        $error = 'Nama, email, dan umur wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif (!ctype_digit($umur) || (int) $umur < 10) {
        $error = 'Umur harus angka dan minimal 10.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO siswa (nama, email, umur) VALUES (:nama, :email, :umur)');
        $stmt->execute([
            ':nama' => $nama,
            ':email' => $email,
            ':umur' => $umur,
        ]);

        $success = 'Data berhasil disimpan.';
        $nama = '';
        $email = '';
        $umur = '';
    }
}

$rows = [];
$total = 0;

try {
    $rows = $pdo->query('SELECT id, nama, email, umur, created_at FROM siswa ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
    $total = count($rows);
} catch (PDOException $e) {
    $error = 'Query gagal. Pastikan kolom umur sudah ditambahkan di database.';
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 6 - PHP + MySQL (PDO)</title>
</head>

<body>
    <h1>Day 6: PHP + MySQL (Insert dan Select)</h1>

    <h2>SQL Buat Tabel</h2>
    <pre>CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>

    <p>SQL tambahan kolom umur:</p>
    <pre>ALTER TABLE siswa ADD COLUMN umur INT NOT NULL AFTER email;</pre>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <h2>Form Insert Data</h2>
    <form method="POST" action="">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

        <label for="umur">Umur:</label></br>
        <input type="number" id="umur" name="umur" value="<?= htmlspecialchars($umur) ?>"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <h2>Data Siswa</h2>
    <?php if (empty($rows)): ?>
        <p>Belum ada data.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Umur</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars((string)$row['umur']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>