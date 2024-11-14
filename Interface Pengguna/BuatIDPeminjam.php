<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat ID Peminjam</title>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }

        #create-id {
            padding: 20px;
            margin: 40px auto;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
        }

        #create-id h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3A415D;
        }

        #create-id label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        #create-id input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        #create-id button {
            padding: 10px;
            background-color: #3A415D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        #create-id button:hover {
            background-color: #ffdd57;
        }

        .redirect-text {
            text-align: center;
            margin-top: 20px;
        }

        .redirect-text a {
            color: #3A415D;
            text-decoration: none;
            font-weight: bold;
        }

        .redirect-text a:hover {
            text-decoration: underline;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #3A415D;
            color: white;
        }

        .header-title {
            font-size: 24px; /* Ukuran font untuk judul */
            margin-left: 10px; /* Jarak antara logo dan teks */
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

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .auth-btn {
            padding: 10px 15px;
            background-color: #ffdd57;
            color: #3A415D;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .auth-btn:hover {
            background-color: #f1c40f;
        }
    </style>
</head>
<body>
<header>
    <img src="../assets/img/kaiadmin/strada1.png" alt="Logo Perpustakaan" style="width: 50px; height: auto;"> <!-- Gambar logo -->
    <h1 class="header-title">Perpustakaan Sekolah</h1>
    <nav>
        <ul>
            <li><a href="user.php">Home</a></li>
            <li><a href="peminjaman.php">Peminjaman Buku</a></li>
            <li><a href="daftarbuku.php">Daftar Buku</a></li>
            <li><a href="sejarah.html">Sejarah Perpustakaan</a></li>
            <li><a href="BuatIDPeminjam.php">Buat ID Peminjam</a></li>
            <li><a href="profil.php">Profil Saya</a></li> <!-- Tautan ke Profil Saya -->
        </ul>
    </nav>
    <div class="auth-buttons">
        <a href="../tables/login.php" class="auth-btn login-btn">Login</a>
        <a href="../tables/login.php" class="auth-btn logout-btn">Logout</a>
    </div>
</header>

<main>
    <section id="create-id">
        <h2>Buat ID Peminjam</h2>
        <form action="" method="POST">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="no_telepon">Nomor Telepon:</label>
            <input type="tel" id="no_telepon" name="no_telepon" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Buat ID Peminjam</button>
        </form>
        <div class="redirect-text">
            <p>Sudah memiliki ID Peminjam? <a href="../tables/login.php">Masuk di sini</a></p>
        </div>
    </section>
</main>

<footer>
    <div class="info-kiri">
        <h2>Kontak Kami</h2>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi kami di:</p>
        <p>Email: perpustakaan@sekolah.com</p>
        <p>Telepon: (021) 98765432</p>
        <p>&copy; 2024 Perpustakaan Sekolah. All rights reserved.</p>
    </div>
    
    <div class="info-kanan">
        <li><a href="#"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        <li><a href="#"><i class="fa-solid fa-phone"></i></a></li>
    </div>
</footer>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menghubungkan ke database
    $servername = "localhost"; // Ganti dengan server Anda
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "db_peminjaman_buku"; // Nama database

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];

    // Siapkan dan bind
    $stmt = $conn->prepare("INSERT INTO peminjam (nama, alamat, no_telepon, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $alamat, $no_telepon, $email);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'ID Peminjam berhasil dibuat.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'User .php';
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan: " . $stmt->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
</body>
</html>