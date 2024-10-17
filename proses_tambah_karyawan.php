<?php
include 'database.php';

$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$no_telepon = $_POST['no_telepon'];
$email = $_POST['email'];

$sql = "INSERT INTO karyawan (nama, jabatan, no_telepon, email) 
        VALUES ('$nama', '$jabatan', '$no_telepon', '$email')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");  // Mengarahkan ke index.php setelah berhasil
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
