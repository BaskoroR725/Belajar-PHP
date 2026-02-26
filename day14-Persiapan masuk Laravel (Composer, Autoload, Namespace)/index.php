<?php
$autoloadPath = __DIR__ . '/vendor/autoload.php';

if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    require_once __DIR__ . '/src/Services/GreetingService.php';
}

$service = new App\Services\GreetingService();
$message = $service->welcome('Teman PHP');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 14 - Persiapan Laravel</title>
</head>
<body>
    <h1>Day 14: Persiapan Masuk Laravel</h1>

    <h2>1. Apa itu Composer?</h2>
    <p>Composer adalah tool untuk mengelola dependency/library PHP dan autoload class otomatis.</p>

    <h2>2. Apa itu Autoload?</h2>
    <p>Autoload adalah mekanisme agar class PHP bisa dipakai tanpa <code>require</code> satu per satu. Composer membuat file autoload untuk ini.</p>

    <h2>3. Apa itu Namespace?</h2>
    <p>Namespace adalah "alamat" class agar nama class tidak bentrok. Contoh: <code>App\Services\GreetingService</code>.</p>

    <h2>4. Contoh Kecil Penggunaan</h2>
    <p>Pesan dari class namespace:</p>
    <p><strong><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></strong></p>

    <h3>Cara coba Composer autoload:</h3>
    <ol>
        <li>Buka terminal di folder day14.</li>
        <li>Jalankan: <code>composer dump-autoload</code></li>
        <li>Refresh file <code>index.php</code>.</li>
    </ol>
</body>
</html>
