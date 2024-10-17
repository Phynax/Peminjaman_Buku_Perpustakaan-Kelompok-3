<?php
include 'database.php';

$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$tahun_terbit = $_POST['tahun_terbit'];
$penerbit = $_POST['penerbit'];
$jumlah_stok = $_POST['jumlah_stok'];

$sql = "INSERT INTO buku (judul, pengarang, tahun_terbit, penerbit, jumlah_stok) 
        VALUES ('$judul', '$pengarang', '$tahun_terbit', '$penerbit', '$jumlah_stok')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");  // Mengarahkan ke index.php setelah berhasil
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
