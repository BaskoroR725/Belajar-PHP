<?php
/*
Tugas Day 5:
1. Ubah agar hanya menerima file gambar (jpg, jpeg, png).
2. Batasi ukuran file maksimal 1MB.
3. Tampilkan preview gambar setelah upload berhasil.
4. Tambahkan validasi: nama file tidak boleh mengandung spasi (sebelum disimpan).
*/

$message = '';
$error = '';
$uploadedFile = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        $error = 'Pilih file gambar terlebih dahulu.';
    } else {
        $file = $_FILES['gambar'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $maxSize = 1 * 1024 * 1024; // 1MB

        $originalName = $file['name'];
        $tmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (strpos($originalName, ' ') !== false) {
            $error = 'Nama file tidak boleh mengandung spasi.';
        } elseif ($fileError !== UPLOAD_ERR_OK) {
            $error = 'Terjadi error saat upload file.';
        } elseif (!in_array($extension, $allowedExtensions, true)) {
            $error = 'Tipe file tidak valid. Hanya jpg, jpeg, png.';
        } elseif ($fileSize > $maxSize) {
            $error = 'Ukuran file terlalu besar. Maksimal 1MB.';
        } else {
            $uploadDir = __DIR__ . '/uploads/';
            $newFileName = uniqid('img_', true) . '.' . $extension;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $destination)) {
                $message = 'Gambar berhasil diupload.';
                $uploadedFile = 'uploads/' . $newFileName;
            } else {
                $error = 'Gagal menyimpan gambar.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Day 5</title>
</head>
<body>
    <h1>Tugas Day 5 - Upload Gambar</h1>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($message !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
        <p>Preview:</p>
        <img src="<?= htmlspecialchars($uploadedFile) ?>" alt="Hasil upload" style="max-width: 300px; height: auto;">
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="gambar">Pilih gambar:</label><br>
        <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

        <button type="submit">Upload Gambar</button>
    </form>
</body>
</html>
