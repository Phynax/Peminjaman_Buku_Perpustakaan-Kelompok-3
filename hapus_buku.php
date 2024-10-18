<?php
include 'database.php';  // Koneksi ke database

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Menghapus data berdasarkan ID
$sql = "DELETE FROM buku WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
