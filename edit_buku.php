<?php
include 'database.php';  // Koneksi ke database

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Mendapatkan data buku berdasarkan ID
$sql = "SELECT * FROM buku WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $jumlah_stok = $_POST['jumlah_stok'];

    // Mengupdate data
    $sql = "UPDATE buku SET judul='$judul', pengarang='$pengarang', tahun_terbit='$tahun_terbit', penerbit='$penerbit', jumlah_stok='$jumlah_stok' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br>
    Pengarang: <input type="text" name="pengarang" value="<?php echo $row['pengarang']; ?>"><br>
    Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>"><br>
    Penerbit: <input type="text" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>
    Jumlah Stok: <input type="number" name="jumlah_stok" value="<?php echo $row['jumlah_stok']; ?>"><br>
    <input type="submit" value="Update">
</form>
