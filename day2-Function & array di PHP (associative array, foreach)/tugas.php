<?php
/**
 * TUGAS DAY 2
 * 
 * 1. Buat sebuah function bernama 'hitungLuas' yang menerima parameter $panjang dan $lebar.
 *    Function ini harus mengembalikan (return) hasil perkalian panjang * lebar.
 * 
 * 2. Buat sebuah Associative Array bernama 'data_siswa' yang berisi:
 *    - nama
 *    - kelas
 *    - hobi
 * 
 * 3. Tampilkan isi array tersebut menggunakan FOREACH.
 */

// Tulis jawabanmu di bawah sini:
echo"1.Function hitung luas.\n";
function hitungLuas($panjang, $lebar){
  return $panjang * $lebar;
};
echo hitungLuas(10, 5);
echo "\n";

echo"2.Associative array. \n";
$data_siswa=[
  "nama" => "Baskoro Ramadhan" ,
  "kelas"=>"12",
  "hobi"=>"Ngoding",
];
echo"\n";

echo"3.Menampilkan Associative array dengan Foreach. \n";
foreach($data_siswa as $siswa){
  echo"$siswa\n";
};


?>
