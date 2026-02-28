<?php

/**
 * index.php - Contoh Implementasi SELECT & INSERT dengan PDO
 * Hari ini kita belajar CRUD (Create & Read).
 */

require_once 'db.php'; // Mengambil koneksi dari db.php

$message = ""; // Untuk pesan status (sukses/gagal)

// 1. Logika INSERT (CREATE)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $name    = htmlspecialchars($_POST['name']); // Sanitasi output ke HTML
  $msg_input = htmlspecialchars($_POST['message']);

  // Best Practice: Prepared Statement
  // Kita tidak langsung memasukkan variabel ke SQL string!
  $sql = "INSERT INTO guestbook (name, message) VALUES (:name, :message)";
  $stmt = $pdo->prepare($sql);

  try {
    // Eksekusi dengan array asosiatif (binding params)
    $stmt->execute([
      ':name'    => $name,
      ':message' => $msg_input
    ]);
    $message = "<div class='alert success'>Data berhasil ditambahkan!</div>";
  } catch (PDOException $e) {
    $message = "<div class='alert error'>Gagal simpan data: " . $e->getMessage() . "</div>";
  }
}

// 2. Logika SELECT (READ)
// Kita ambil semua data dari tabel guestbook, urutkan dari yang terbaru
$stmt = $pdo->prepare("SELECT * FROM guestbook ORDER BY created_at DESC");
$stmt->execute();
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Day 6: PHP + MySQL Guestbook</title>
  <style>
    :root {
      --primary: #6366f1;
      --bg: #f8fafc;
      --text: #1e293b;
      --card-bg: #ffffff;
      --success: #22c55e;
      --error: #ef4444;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
      margin: 0;
      padding: 2rem;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    header h1 {
      color: var(--primary);
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }

    .card {
      background: var(--card-bg);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    input,
    textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #e2e8f0;
      border-radius: 0.5rem;
      box-sizing: border-box;
      transition: border-color 0.2s;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    button {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, opacity 0.2s;
    }

    button:hover {
      opacity: 0.9;
    }

    button:active {
      transform: scale(0.98);
    }

    .alert {
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
      font-weight: 500;
    }

    .alert.success {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #bbf7d0;
    }

    .alert.error {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th,
    td {
      text-align: left;
      padding: 1rem;
      border-bottom: 1px solid #e2e8f0;
    }

    th {
      background: #f1f5f9;
      font-weight: 700;
      color: #475569;
    }

    .empty {
      text-align: center;
      color: #94a3b8;
      padding: 2rem;
      font-style: italic;
    }
  </style>
</head>

<body>

  <div class="container">
    <header>
      <h1>📖 Guestbook App</h1>
      <p>Belajar PHP Native + MySQL (PDO) Day 6</p>
    </header>

    <!-- FORM INPUT -->
    <div class="card">
      <h3>📝 Tambah Pesan</h3>
      <?php echo $message; ?>
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" name="name" id="name" required placeholder="Contoh: Baskoro">
        </div>
        <div class="form-group">
          <label for="message">Pesan</label>
          <textarea name="message" id="message" rows="4" required placeholder="Tulis pesanmu di sini..."></textarea>
        </div>
        <button type="submit" name="submit">Kirim Sekarang</button>
      </form>
    </div>

    <!-- TABEL DATA -->
    <div class="card">
      <h3>📊 Daftar Pesan</h3>
      <table>
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Nama</th>
            <th>Pesan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($data) > 0): ?>
            <?php foreach ($data as $row): ?>
              <tr>
                <td><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></td>
                <td><strong><?php echo $row['name']; ?></strong></td>
                <td><?php echo nl2br($row['message']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="empty">Belum ada pesan. Silakan isi form di atas!</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>