<?php
// 1. Function (Fungsi)
// Cara membungkus logika agar bisa dipakai berulang kali.
function sapa($nama) {
    return "Halo, $nama! Selamat belajar PHP Day 2.\n";
}

echo sapa("Baskoro");
echo "----------------------------------\n";

// 2. Indexed Array
// Daftar biasa dengan urutan angka (0, 1, 2...)
$laptop = ["Asus", "Lenovo", "Macbook"];

echo "Laptop pertama saya: " . $laptop[0] . "\n";
echo "----------------------------------\n";

// 3. Associative Array
// Daftar yang punya "nama kunci" (key) sendiri, bukan angka.
$user = [
    "username" => "BaskoroR725",
    "email" => "baskoro@example.com",
    "status" => "Belajar"
];

echo "Email user: " . $user["email"] . "\n";
echo "----------------------------------\n";

// 4. Foreach (Loop khusus Array)
// Sangat sering dipakai di Laravel nanti untuk menampilkan data.
$buah = ["Apel", "Mangga", "Pisang"];

echo "Daftar Buah:\n";
foreach ($buah as $item) {
    echo "- $item\n";
}
?>
