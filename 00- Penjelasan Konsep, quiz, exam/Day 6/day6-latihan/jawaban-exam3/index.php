<?php
session_start();
require_once 'connection.php';

// Flash messages from Session, agar tersimpan disession dan tidak hilang saat refresh
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

$nama = '';
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $pesan = trim($_POST['pesan'] ?? '');

  if ($nama === '' || $pesan === '') {
    $_SESSION['error'] = 'Mohon lengkapi semua data. Nama dan pesan wajib diisi.';
    //redirect ke index agar tidak tersubmit 2x
    header('Location: index.php');
    exit;
  } else {
    try {
      $insertsql = 'INSERT INTO tamu (nama, pesan) VALUES (:nama, :pesan)';
      $stmt = $pdo->prepare($insertsql);
      $stmt->execute([
        'nama'  => $nama,
        'pesan' => $pesan
      ]);
      $_SESSION['success'] = 'Terima kasih! Pesan Anda telah berhasil disimpan.';
      header('Location: index.php');
      exit;
    } catch (PDOException $e) {
      $_SESSION['error'] = 'Waduh, ada kendala teknis: ' . $e->getMessage();
      header('Location: index.php');
      exit;
    }
  }
}

// Get guestbook entries
$rows = [];
try {
  $rows = $pdo->query('SELECT id, nama, pesan, waktu_kirim FROM tamu ORDER BY id DESC')->fetchAll();
} catch (PDOException $e) {
  $_SESSION['error'] = 'Gagal memuat data: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premium Guestbook | PHP Deep Dive</title>
  <!-- Modern Typography -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #6366f1;
      --primary-hover: #4f46e5;
      --bg: #0f172a;
      --card-bg: #1e293b;
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --success: #10b981;
      --error: #ef4444;
      --glass: rgba(30, 41, 59, 0.7);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: var(--bg);
      background-image:
        radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0, transparent 50%),
        radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.1) 0, transparent 50%);
      color: var(--text-main);
      min-height: 100vh;
      padding: 2rem 1rem;
      line-height: 1.6;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    h1,
    h2 {
      font-family: 'Outfit', sans-serif;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
    }

    h1 {
      font-size: 2.5rem;
      font-weight: 800;
      text-align: center;
      background: linear-gradient(to right, #6366f1, #a855f7);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Flash Messages */
    .alert {
      padding: 1rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      font-weight: 500;
      animation: slideIn 0.3s ease-out;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-success {
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid var(--success);
      color: var(--success);
    }

    .alert-error {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid var(--error);
      color: var(--error);
    }

    @keyframes slideIn {
      from {
        transform: translateY(-10px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    /* Form Styling */
    .card {
      background: var(--glass);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      margin-bottom: 3rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text-muted);
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    input,
    textarea {
      width: 100%;
      background: rgba(15, 23, 42, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 0.75rem 1rem;
      color: white;
      font-size: 1rem;
      transition: all 0.2s;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    }

    button {
      width: 100%;
      background: var(--primary);
      color: white;
      border: none;
      padding: 1rem;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    button:hover {
      background: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
    }

    button:active {
      transform: translateY(0);
    }

    /* List Styling */
    .entry-list {
      display: grid;
      gap: 1.5rem;
    }

    .entry-card {
      background: var(--card-bg);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 20px;
      padding: 1.5rem;
      transition: transform 0.2s;
    }

    .entry-card:hover {
      transform: scale(1.02);
      border-color: rgba(99, 102, 241, 0.3);
    }

    .entry-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .entry-author {
      font-weight: 700;
      color: var(--primary);
      font-size: 1.125rem;
    }

    .entry-time {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    .entry-content {
      color: #cbd5e1;
      white-space: pre-wrap;
      word-break: break-all;
    }

    .empty-state {
      text-align: center;
      padding: 3rem;
      color: var(--text-muted);
      border: 2px dashed rgba(255, 255, 255, 0.1);
      border-radius: 24px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Buku Tamu Digital</h1>

    <!-- Flash Messages -->
    <?php if ($success): ?>
      <div class="alert alert-success">
        <span>✓</span> <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="alert alert-error">
        <span>⚠</span> <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="card">
      <form action="" method="post">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" placeholder="Siapa nama Anda?" value="<?= htmlspecialchars($nama) ?>" required>
        </div>
        <div class="form-group">
          <label for="pesan">Pesan / Testimonial</label>
          <textarea name="pesan" id="pesan" rows="4" placeholder="Tuliskan sesuatu yang menarik..." required><?= htmlspecialchars($pesan) ?></textarea>
        </div>
        <button type="submit">Kirim Pesan</button>
      </form>
    </div>

    <!-- Entries List -->
    <h2>Daftar Pesan Terbaru</h2>
    <?php if (empty($rows)): ?>
      <div class="empty-state">
        <p>Belum ada pesan yang masuk. Jadilah yang pertama!</p>
      </div>
    <?php else: ?>
      <div class="entry-list">
        <?php foreach ($rows as $row): ?>
          <div class="entry-card">
            <div class="entry-header">
              <span class="entry-author"><?= htmlspecialchars($row['nama']) ?></span>
              <span class="entry-time">
                <?= date('d M Y • H:i', strtotime($row['waktu_kirim'])) ?>
              </span>
            </div>
            <div class="entry-content"><?= nl2br(htmlspecialchars($row['pesan'])) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>