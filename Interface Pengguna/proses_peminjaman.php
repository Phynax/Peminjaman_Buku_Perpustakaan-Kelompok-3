<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$dbname = 'db_peminjaman_buku'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat']; // Menambahkan alamat
$no_telepon = $_POST['no_telepon']; // Menambahkan nomor telepon


// Menyimpan data peminjam ke dalam database
$sql_peminjam = "INSERT INTO peminjam (nama, alamat, no_telepon, email) VALUES (?, ?, ?, ?)";
$stmt_peminjam = $conn->prepare($sql_peminjam);
$stmt_peminjam->bind_param("ssss", $nama, $alamat, $no_telepon, $email);

if ($stmt_peminjam->execute()) {
    // Mendapatkan ID peminjam yang baru saja ditambahkan
    $id_peminjam = $stmt_peminjam->insert_id;

    // Menyimpan data peminjaman ke dalam database
    $sql_peminjaman = "INSERT INTO peminjaman (id_peminjam, buku_id, tanggal) VALUES (?, ?, ?)";
    $stmt_peminjaman = $conn->prepare($sql_peminjaman);
    $stmt_peminjaman->bind_param("iis", $id_peminjam, $buku_id, $tanggal);

    if ($stmt_peminjaman->execute()) {
        // Mengurangi jumlah stok buku setelah peminjaman
        $update_sql = "UPDATE buku SET jumlah_stok = jumlah_stok - 1 WHERE id_buku = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $buku_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Jika berhasil, redirect dengan pesan
        header("Location: peminjaman.php?pesan=peminjaman");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $stmt_peminjaman->error;
    }
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $stmt_peminjam->error;
}

// Menutup koneksi
$stmt_peminjaman->close();
$stmt_peminjam->close();
$conn->close();
?>