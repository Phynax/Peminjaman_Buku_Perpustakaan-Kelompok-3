<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Contoh data yang akan ditampilkan di tabel
$dataBuku = [
    ['ID Buku' => '101', 'Judul' => 'Pemrograman Web', 'Pengarang' => 'John Doe', 'Tahun' => '2020'],
    ['ID Buku' => '102', 'Judul' => 'Algoritma dan Struktur Data', 'Pengarang' => 'Jane Doe', 'Tahun' => '2019'],
    ['ID Buku' => '103', 'Judul' => 'Desain Basis Data', 'Pengarang' => 'Albert Smith', 'Tahun' => '2021'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="style.css"> <!-- Menggunakan CSS yang sama -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang, <?php echo $_SESSION['user']; ?>!</h1>
        <p>Anda berhasil login.</p>

        <!-- Tabel untuk menampilkan data buku -->
        <table>
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataBuku as $buku): ?>
                <tr>
                    <td><?php echo $buku['ID Buku']; ?></td>
                    <td><?php echo $buku['Judul']; ?></td>
                    <td><?php echo $buku['Pengarang']; ?></td>
                    <td><?php echo $buku['Tahun']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
