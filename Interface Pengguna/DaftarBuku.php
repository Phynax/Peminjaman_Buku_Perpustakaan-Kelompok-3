<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan Sekolah</title>
    <script src="https://kit.fontawesome.com/1c46902ba5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <style>
        body {
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
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
    <section id="daftarbuku">
        <h2>Daftar Buku Tersedia</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $dbname = 'db_peminjaman_buku';

                $conn = new mysqli($host, $user, $password, $dbname);

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Mengambil dan menampilkan daftar buku
                $sql = "SELECT * FROM buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result ->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id_buku'] . "</td>
                                <td>" . $row['judul'] . "</td>
                                <td>" . $row['pengarang'] . "</td>
                                <td>" . $row['tahun_terbit'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada buku tersedia</td></tr>";
                }
                $conn->close(); // Menutup koneksi
                ?>
            </tbody>
        </table>
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
        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const pesan = url.searchParams.get('pesan');

    document.addEventListener('DOMContentLoaded', function() {
        if (pesan === 'peminjaman') {
            Swal.fire({
                title: 'Peminjaman Berhasil!',
                text: 'Terima kasih telah meminjam buku!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                url.searchParams.delete('pesan');
                window.history.replaceState({}, document.title, url);
            });
        }
    });
</script>
</html>