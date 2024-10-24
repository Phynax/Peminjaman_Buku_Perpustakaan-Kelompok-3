<?php
include 'database.php';  // Koneksi ke database

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Mendapatkan data karyawan berdasarkan ID
$sql = "SELECT * FROM karyawan WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];

    // Mengupdate data
    $sql = "UPDATE karyawan SET nama='$nama', jabatan='$jabatan', no_telepon='$no_telepon', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
    Jabatan: <input type="text" name="jabatan" value="<?php echo $row['jabatan']; ?>"><br>
    No Telepon: <input type="text" name="no_telepon" value="<?php echo $row['no_telepon']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
    <input type="submit" value="Update">
</form>
