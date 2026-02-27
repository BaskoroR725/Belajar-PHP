# Kunci Jawaban Quiz Day 6

1. **Apa kepanjangan dari PDO?**
   - PHP Data Objects.

2. **Mengapa menggunakan Prepared Statements?**
   - Untuk mencegah **SQL Injection**. Prepared statements memisahkan antara instruksi query dengan data input, sehingga input user tidak bisa dianggap sebagai perintah SQL.

3. **Urutan langkah menarik data (PDO):**
   - `prepare()`: Menyiapkan query.
   - `execute()`: Menjalankan query (dengan parameter jika ada).
   - `fetch()` atau `fetchAll()`: Mengambil hasil data.

4. **Fungsi try-catch:**
   - Untuk menangani error (exception) secara elegan. Jika koneksi gagal, program tidak langsung "mati" dengan error merah yang berantakan, melainkan kita bisa menangkap pesannya dan menampilkan info yang lebih rapi.

5. **SQL Query:**
   ```sql
   SELECT * FROM produk WHERE harga > 50000;
   ```
