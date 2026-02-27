# Day 6: PHP & MySQL (Database Dasar)

Setelah menguasai Session di Day 4, hari ini kita akan masuk ke bagian paling krusial: **Interaksi dengan Database**.

## 1. Apa itu MySQL?

MySQL adalah Database Management System (DBMS) yang menggunakan gaya SQL (Structured Query Language). PHP punya 2 cara utama bicara dengan MySQL:

1. `mysqli` (MySQL Improved)
2. `PDO` (PHP Data Objects) - **Direkomendasikan** karena lebih aman dan mendukung banyak database.

## 2. Koneksi ke Database (PDO)

Untuk menghubungkan PHP ke MySQL, kita butuh: `host`, `db_name`, `username`, dan `password`.

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "belajar_php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set error mode ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Koneksi Berhasil!";
} catch(PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
```

## 3. Menjalankan Query (SELECT)

Gunakan `prepare()` dan `execute()` untuk keamanan (menghindari SQL Injection).

```php
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    echo $user['username'];
}
```

## 4. Menambah Data (INSERT)

```php
$sql = "INSERT INTO users (username, password) VALUES (:user, :pass)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':user' => 'baskoro',
    ':pass' => password_hash('rahasia', PASSWORD_DEFAULT)
]);
```

## 5. Ringkasan Konsep

- **CRUD**: Create, Read, Update, Delete.
- **SQL Injection**: Bahaya keamanan di mana user menyisipkan kode jahat ke query.
- **Prepared Statements**: Cara terbaik mencegah SQL Injection.
