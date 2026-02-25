<?php
/**
 * TUGAS DAY 1
 * 
 * 1. Buat variabel $umur.
 * 2. Gunakan IF ELSE untuk menentukan kategori:
 *    - Di bawah 13 tahun: "Anak-anak"
 *    - 13 - 19 tahun: "Remaja"
 *    - 20 tahun ke atas: "Dewasa"
 * 3. Gunakan LOOP (for) untuk menampilkan angka GANJIL saja dari 1 sampai 10.
 */

// Tulis jawabanmu di bawah sini:
echo "Nomor 1.\n";
$umur=31;

echo "Nomor 2. Umur saya $umur tahun.\n";
if($umur < 13){
  echo"Anak-anak\n";
}elseif($umur <= 19){
  echo"Remaja\n";
}elseif($umur > 20){
  echo"Dewasa\n";
};

echo "Nomor 3.\n";
for($i=1;$i<=10;$i++){
  if($i%2==1){
    echo "$i\n";
  }
}



?>
