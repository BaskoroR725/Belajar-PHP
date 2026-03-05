<?php
$message = '';
$error = '';
$uploadedFileName = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] === UPLOAD_ERR_NO_FILE) {
        $error = 'Pilih file terlebih dahulu.';
    } else {
        $file = $_FILES['file_upload'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        $originalName = $file['name'];
        $tmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if ($fileError !== UPLOAD_ERR_OK) {
            $error = 'Terjadi error saat upload file.';
        } elseif (!in_array($extension, $allowedExtensions, true)) {
            $error = 'Tipe file tidak diizinkan. Gunakan: jpg, jpeg, png, atau pdf.';
        } elseif ($fileSize > $maxSize) {
            $error = 'Ukuran file terlalu besar. Maksimal 2MB.';
        } else {
            $uploadDir = __DIR__ . '/uploads/';
            $newFileName = uniqid('file_', true) . '.' . $extension;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $destination)) {
                $message = 'File berhasil diupload.';
                $uploadedFileName = $newFileName;
            } else {
                $error = 'Gagal menyimpan file ke folder uploads.';
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
    <title>Day 5 - Upload File PHP</title>
</head>
<body>
    <h1>Day 5: Upload File di PHP</h1>
    <p>Tipe file yang diizinkan: <strong>jpg, jpeg, png, pdf</strong> (max 2MB)</p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($message !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
        <p>Nama file tersimpan: <strong><?= htmlspecialchars($uploadedFileName) ?></strong></p>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="file_upload">Pilih file:</label><br>
        <input type="file" id="file_upload" name="file_upload"><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>
