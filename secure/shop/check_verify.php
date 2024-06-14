<?php
// Sertakan file koneksi.php
require_once "koneksi.php";

// Mulai sesi
session_start();

// Periksa apakah pengguna telah login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // Jika tidak, kirim respons "unauthorized"
    http_response_code(401);
    echo "Unauthorized";
    exit;
}

// Ambil username dari session
$username = $_SESSION["username"];

// Query untuk memeriksa keberadaan username dalam tabel pengguna
$sql = "SELECT * FROM pengguna WHERE username = '$username'";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    // Kesalahan saat menjalankan query
    echo "Error: " . mysqli_error($koneksi);
} else {
    // Cek jumlah baris yang dikembalikan oleh query
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
        // Username ditemukan
        echo "exists";
    } else {
        // Username tidak ditemukan
        echo "not_exists";
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
