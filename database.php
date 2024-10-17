<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_peminjaman_buku";  // Nama database baru

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
