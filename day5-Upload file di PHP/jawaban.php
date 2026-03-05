<?php
$message='';
$error='';
$uploadedFile ='';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE){
    $error = 'Pilih file gambar terlebih dahulu.';
  }else{
    $files=$_FILES['gambar'];
    $allowedExtension = ['jpg','png','jpeg'];
    $maxSize=1 * 1024 *1024; //1mb

    $originalName=$files['name'];
    $tmpName = $files['tmp_name'];
    $fileSize = $files['size'];
    $fileError=$files['error'];
    $extensions= strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    
    if(strpos($originalName, ' ') !== false){
      $error = 'Nama gambar tidak boleh ada spasi';
    }elseif($fileError !== UPLOAD_ERR_OK){
      $error= 'Terjadi masalah saat upload gambar';
    }elseif(!in_array($extensions, $allowedExtension, true)){
      $error = 'Tipe file tidak valid. Hanya jpg, jpeg, png.';
    }elseif($fileSize > $maxSize){
      $error = 'file size tidak boleh melebihi 1 mb';
    }else{
      $uploadDir = __DIR__.'/uploads/';

      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
      }
      $newFileName = uniqid('img_', true).'.'.$extensions;
      $destination = $uploadDir . $newFileName;
    
      if(move_uploaded_file($tmpName, $destination)){
        $message = 'Gambar berhasil diupload';
        $uploadedFile = 'uploads/'.$newFileName;
      }else{
        $error = 'Gagal menyimpan gambar';
      }
    };
  };
};

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