<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Peminjaman Buku</title>
    <script src="https://kit.fontawesome.com/1c46902ba5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
</head>
<body>
    <header>
        <h1>Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></li>
                <li><a href="daftar-buku.php">Daftar Buku</a></li>
                <li><a href="sejarah.php">Sejarah Perpustakaan</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="login.php" class="auth-btn login-btn">Login</a>
            <a href="logout.php" class="auth-btn logout-btn">Logout</a>
        </div>
    </header>

    <main>
        <section id="intro-section">
            <div class="intro-content">
                <div class="intro-image">
                    <img src="../assets/library.jpg" alt="Perpustakaan">
                </div>
                <div class="intro-text">
                    <h2>Selamat datang di Perpustakaan Sekolah!</h2>
                    <p>Kami menyediakan berbagai koleksi buku untuk menunjang pendidikan dan pengetahuan Anda. Silakan jelajahi koleksi kami dan lakukan peminjaman buku secara online.</p>
                </div>
            </div>
        </section>

        <section id="peminjaman">
            <h2>Peminjaman Buku</h2>
            <form action="proses_peminjaman.php" method="POST">
                <label for="nama">Nama Peminjam:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="buku">Pilih Buku:</label>
                <select id="buku" name="buku" required>
                    <option value="">-- Pilih Buku --</option>
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

                    // Mengambil data dari tabel buku
                    $sql = "SELECT * FROM buku";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Menampilkan data buku
                        while ($row = $result->fetch_assoc()) echo "<option value='" . $row['id'] . "'>" . $row['judul'] . "</option>";
                        }
                     else {
                        echo "<option value=''>Tidak ada buku tersedia</option>";
                    }
                    $conn->close(); // Menutup koneksi
                    ?>
                </select>

                <label for="tanggal">Tanggal Peminjaman:</label>
                <input type="date" id="tanggal" name="tanggal" required>

                <button type="submit">Pinjam Buku</button>
            </form>
        </section>

        <section id="daftar-buku">
            <h2>Daftar Buku Tersedia</h2>
            <ul>
                <?php
                // Koneksi ke database
                $conn = new mysqli($host, $user, $password, $dbname);

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Mengambil dan menampilkan daftar buku
                $sql = "SELECT * FROM buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row['judul'] . " - " . $row['pengarang'] . "</li>"; // Ganti 'penulis' dengan nama kolom yang sesuai
                    }
                } else {
                    echo "<li>Tidak ada buku tersedia</li>";
                }
                $conn->close(); // Menutup koneksi
                ?>
            </ul>
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
        <div class="info-mid">
            <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
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