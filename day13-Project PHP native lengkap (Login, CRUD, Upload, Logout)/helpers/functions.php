<?php
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function uploadImage(array $file, string $uploadDir): array
{
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['success' => true, 'filename' => null, 'error' => ''];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'filename' => null, 'error' => 'Upload file gagal.'];
    }

    $allowed = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed, true)) {
        return ['success' => false, 'filename' => null, 'error' => 'Tipe file harus jpg, jpeg, atau png.'];
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return ['success' => false, 'filename' => null, 'error' => 'Ukuran file maksimal 2MB.'];
    }

    $newName = uniqid('img_', true) . '.' . $ext;
    $destination = rtrim($uploadDir, '/\\') . DIRECTORY_SEPARATOR . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => false, 'filename' => null, 'error' => 'Gagal menyimpan file upload.'];
    }

    return ['success' => true, 'filename' => $newName, 'error' => ''];
}
