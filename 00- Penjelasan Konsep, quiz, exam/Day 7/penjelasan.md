# Day 7: PHP Native CRUD (Update & Delete)

Setelah bisa menambah (**Create**) dan menampilkan (**Read**) data di Day 6, hari ini kita akan melengkapi siklus **CRUD** dengan mempelajari **Update** (Ubah) dan **Delete** (Hapus).

## 1. Konsep Update (Ubah Data)

Proses Update biasanya membutuhkan dua tahap:

1.  **Ambil Data Lama**: Menampilkan data yang mau diedit ke dalam form (menggunakan `SELECT ... WHERE id = :id`).
2.  **Simpan Perubahan**: Mengirim data baru ke database (menggunakan `UPDATE ... SET ... WHERE id = :id`).

### Contoh Query Update:

```php
$sql = "UPDATE tamu SET nama = :nama, pesan = :pesan WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nama'  => 'Baskoro Baru',
    ':pesan' => 'Pesan sudah diupdate',
    ':id'    => 1
]);
```

> [!IMPORTANT]
> Jangan pernah lupa klausa `WHERE` pada perintah `UPDATE`! Jika lupa, **semua data** di tabel tersebut akan berubah menjadi sama semua.

---

## 2. Konsep Delete (Hapus Data)

Menghapus data sangat simpel, tapi harus sangat hati-hati. Biasanya kita mengirim `id` melalui URL (misal: `delete.php?id=5`).

### Contoh Query Delete:

```php
$sql = "DELETE FROM tamu WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
```

---

## 3. Best Practice: Post-Redirect-Get (PRG)

Pernahkah kamu refresh halaman setelah submit form lalu muncul peringatan "Confirm Form Resubmission"?

Itu terjadi karena browser mencoba mengirim ulang data POST. Untuk menghindarinya, setelah proses **Insert/Update/Delete** selesai, gunakan `header("Location: ...")` untuk mengarahkan user kembali ke halaman daftar.

```php
// Setelah execute query:
header("Location: index.php?status=success");
exit;
```

---

## 4. Ringkasan Day 7

- **CRUD** lengkap: Create, Read, Update, Delete.
- **WHERE Clause**: Kunci utama untuk menargetkan data yang spesifik.
- **URL Parameters**: Digunakan untuk mengirim `id` saat ingin mengedit atau menghapus data.
