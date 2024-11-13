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
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <style>
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
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="user.php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></l>
                <li><a href="daftarbuku.php">Daftar Buku</a></li>
                <li><a href="sejarah.php">Sejarah Perpustakaan</a></li>
            </ul>
        </nav>
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