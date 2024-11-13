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

// Memeriksa apakah data POST ada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_peminjam = isset($_POST['id_peminjam']) ? $_POST['id_peminjam'] : null;
    $id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : null;
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : null;
    $tanggal_kembali = isset($_POST['tanggal_kembali']) ? $_POST['tanggal_kembali'] : null;

    // Memeriksa apakah semua data ada
    if ($id_peminjam && $id_buku && $tanggal_pinjam) {
        // Menyimpan data peminjaman ke dalam database
        $sql_peminjaman = "INSERT INTO peminjaman (id_peminjam, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)";
        $stmt_peminjaman = $conn->prepare($sql_peminjaman);

        if ($stmt_peminjaman === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Mengikat parameter
        $stmt_peminjaman->bind_param("iiss", $id_peminjam, $id_buku, $tanggal_pinjam, $tanggal_kembali);

        if ($stmt_peminjaman->execute()) {
            // Jika berhasil, redirect dengan pesan
            header("Location: peminjaman.php?pesan=peminjaman");
            exit(); // Pastikan untuk keluar setelah redirect
        } else {
            // Jika gagal, tampilkan pesan error
            echo "Error: " . $stmt_peminjaman->error;
        }

        // Menutup koneksi
        $stmt_peminjaman->close();
    } else {
        echo "Semua field harus di isi.";
    }
} else {
    echo "Tidak ada data yang dikirim.";
}

$conn->close();
?>