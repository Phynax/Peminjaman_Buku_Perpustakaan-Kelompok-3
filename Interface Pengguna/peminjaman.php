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

        // Menutup statement
        $stmt_peminjaman->close();
    } else {
        echo "Semua field harus di isi.";
    }
}

// Mengambil daftar peminjaman
$sql_peminjaman = "SELECT p.id_peminjam, p.tanggal_pinjam, p.tanggal_kembali, b.judul 
                   FROM peminjaman p 
                   JOIN buku b ON p.id_buku = b.id_buku";
$result_peminjaman = $conn->query($sql_peminjaman);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku - Perpustakaan Sekolah</title>
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
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50; /* Warna latar belakang header */
            color: white; /* Warna teks header */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna latar belakang baris genap */
        }
        tr:hover {
            background-color: #ddd; /* Warna latar belakang saat hover */
        }
        button {
            background-color: #4CAF50; /* Warna latar belakang tombol */
            color: white; /* Warna teks tombol */
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; /* Warna latar belakang tombol saat hover */
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding:  10px 20px;
            background-color: #3A415D;
            color: white;
        }
        .header-title {
            font-size: 1.5em; /* Ukuran teks lebih kecil */
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
    <section id="peminjaman">
        <h2>Peminjaman Buku</h2>
        <form action="peminjaman.php" method="POST">
            <label for="id_peminjam">ID Peminjam:</label>
            <select id="id_peminjam" name="id_peminjam" required>
                <option value="">-- Pilih Peminjam --</option>
                <?php
                // Mengambil data dari tabel peminjam
                $sql = "SELECT * FROM peminjam";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_peminjam'] . "'>" . $row['nama'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada peminjam tersedia</option>";
                }
                ?>
            </select>

            <label for="id_buku">Pilih Buku:</label>
            <select id="id_buku" name="id_buku" required>
                <option value="">-- Pilih Buku --</option>
                <?php
                // Mengambil data dari tabel buku
                $sql = "SELECT * FROM buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_buku'] . "'>" . $row['judul'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada buku tersedia</option>";
                }
                ?>
            </select>

            <label for="tanggal_pinjam">Tanggal Peminjaman:</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required>

            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali">

            <button type="submit">Pinjam Buku</button>
        </form>
    </section>

    <section id="daftar-peminjaman">
        <h2>Daftar Peminjaman</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_peminjaman && $result_peminjaman->num_rows > 0) {
                    while ($row = $result_peminjaman->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id_peminjam'] . "</td>
                                <td>" . $row['judul'] . "</td>
                                <td>" . $row['tanggal_pinjam'] . "</td>
                                <td>" . $row['tanggal_kembali'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada peminjaman yang ditemukan.</td></tr>";
                }
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
</footer>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>