<?php
// 1. Variabel & Tipe Data
$nama = "Baskoro"; // String
$umur = 25;       // Integer
$belajar = true;  // Boolean

echo "Halo, nama saya $nama. Umur saya $umur tahun.\n";
echo "----------------------------------\n";

// 2. If Else (Logika)
$nilai = 85;

if ($nilai >= 80) {
    echo "Hasil: Sangat Baik\n";
} elseif ($nilai >= 60) {
    echo "Hasil: Cukup\n";
} else {
    echo "Hasil: Perlu Belajar Lagi\n";
}
echo "----------------------------------\n";

// 3. Loop (Pengulangan)
echo "Menghitung 1 sampai 5:\n";
for ($i = 1; $i <= 5; $i++) {
    echo "Angka ke-$i\n";
}
?>
