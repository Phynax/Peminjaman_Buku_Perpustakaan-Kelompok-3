<?php
// Menghubungkan ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_peminjaman_buku";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID pengguna dari sesi atau parameter
session_start();
$id_peminjam = $_SESSION['id_peminjam'] ?? null; // Menggunakan null coalescing operator

if ($id_peminjam === null) {
    die("ID peminjam tidak ditemukan. Silakan login terlebih dahulu.");
}

// Mengambil data pengguna dari database
$sql = "SELECT * FROM peminjam WHERE id_peminjam = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_peminjam);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Data pengguna tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <style>
        body {
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }

        .profile-box {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 250px;
        }

        .profile-box h3 {
            margin: 0 0 10px;
            color: #3A415D;
        }

        .profile-box p {
            margin: 5px 0;
        }

        .profile-box a {
            display: block;
            margin-top: 10px;
            text-align: center;
            background-color: #3A415D;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .profile-box a:hover {
            background-color: #ffdd57;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #3A415D;
            color: white;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #3A415D;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="user.php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></li>
                <li><a href="daftarbuku.php">Daftar Buku</a></li>
                <li><a href="sejarah.html">Sejarah Perpustakaan</a></li>
                <li><a href="create_id.php">Buat ID Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-box">
        <h3>Profil Pengguna</h3>
        <p>Nama: <?php echo htmlspecialchars($user['nama']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Telepon: <?php echo htmlspecialchars($user['telepon']); ?></p>
        <a href="profil.php">Edit Profil</a>
    </div>

    <main>
        <h2> Selamat datang di Perpustakaan Sekolah!</h2>
        <p>Ini adalah halaman utama perpustakaan.</p>
        <!-- Konten lainnya -->
    </main>

    <footer>
        <p>&copy; 2023 Perpustakaan. Semua hak dilindungi.</p>
    </footer>

    <?php
    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>