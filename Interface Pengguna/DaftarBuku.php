<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan Sekolah</title>
    <script src="https://kit.fontawesome.com/1c46902ba5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <style>
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
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="User.php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></li>
                <li><a href="daftarbuku.php">Daftar Buku</a></li>
                <li><a href="sejarah.html">Sejarah Perpustakaan</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="login.php" class="auth-btn login-btn">Login</a>
            <a href="logout.php" class="auth-btn logout-btn">Logout</a>
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
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id_buku'] . "</td>
                                    <td>" . $row['judul'] . "</td>
                                    <td>" . $row['pengarang'] . "</td>
                                    <td>" . $row['tahun_terbit'] . "</td> <!-- Ganti 'tahun_terbit' dengan nama kolom yang sesuai -->
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
        </div </footer>
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