<?php
include 'database.php';  // Koneksi ke database

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Mendapatkan data peminjam berdasarkan ID
$sql = "SELECT * FROM peminjam WHERE id = $id";
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
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];

    // Mengupdate data
    $sql = "UPDATE peminjam SET nama='$nama', alamat='$alamat', no_telepon='$no_telepon', email='$email' WHERE id=$id";

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
    Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
    No Telepon: <input type="text" name="no_telepon" value="<?php echo $row['no_telepon']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
    <input type="submit" value="Update">
</form>
