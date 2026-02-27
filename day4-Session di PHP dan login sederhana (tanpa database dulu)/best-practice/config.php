<?php
/**
 * Konfigurasi Akun Demo & Session
 * Best Practice: Gunakan konstanta untuk data yang tidak berubah.
 */

define('DEMO_USER', 'userday4');
define('DEMO_PASS', 'passday4');

// Memulai session dengan pengaturan keamanan tambahan (opsional tapi bagus)
// ini bisa dikonsep di php.ini atau di runtime
session_start([
    'cookie_httponly' => true, // Mencegah akses cookie via JavaScript (XSS)
    'cookie_secure'   => false, // Set true jika menggunakan HTTPS
    'use_only_cookies' => true,
]);
