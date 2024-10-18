<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .add-button:hover {
            background-color: #218838;
        }
        .button-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>Data Peminjaman Buku</h1>

    <!-- Tombol untuk Menambah Data -->
    <div class="button-container">
        <a href="tambah_peminjam.php" class="add-button">Tambah Peminjam</a>
        <a href="tambah_buku.php" class="add-button">Tambah Buku</a>
        <a href="tambah_karyawan.php" class="add-button">Tambah Karyawan</a>
    </div>

    <!-- Tabel Peminjam -->
    <h2>Data Peminjam</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Email</th>
            <th>Aksi</th> <!-- Kolom untuk Edit dan Hapus -->
        </tr>
        <?php
        include 'database.php';  // Pastikan koneksi ke database
        $sql = "SELECT * FROM peminjam";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["alamat"] . "</td><td>" . $row["no_telepon"] . "</td><td>" . $row["email"] . "</td>";
                if (isset($row["id"])) {
                    echo "<td><a href='edit_peminjam.php?id=" . $row["id"] . "'>Edit</a> | <a href='hapus_peminjam.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
                } else {
                    echo "<td>ID tidak ditemukan</td></tr>";
                }
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data peminjam</td></tr>";
        }
        ?>
    </table>

    <!-- Tabel Buku -->
    <h2>Data Buku</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Penerbit</th>
            <th>Jumlah Stok</th>
            <th>Aksi</th> <!-- Kolom untuk Edit dan Hapus -->
        </tr>
        <?php
        $sql = "SELECT * FROM buku";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["judul"] . "</td><td>" . $row["pengarang"] . "</td><td>" . $row["tahun_terbit"] . "</td><td>" . $row["penerbit"] . "</td><td>" . $row["jumlah_stok"] . "</td>";
                if (isset($row["id"])) {
                    echo "<td><a href='edit_buku.php?id=" . $row["id"] . "'>Edit</a> | <a href='hapus_buku.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
                } else {
                    echo "<td>ID tidak ditemukan</td></tr>";
                }
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data buku</td></tr>";
        }
        ?>
    </table>

    <!-- Tabel Karyawan -->
    <h2>Data Karyawan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>No Telepon</th>
            <th>Email</th>
            <th>Aksi</th> <!-- Kolom untuk Edit dan Hapus -->
        </tr>
        <?php
        $sql = "SELECT * FROM karyawan";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nama"] . "</td><td>" . $row["jabatan"] . "</td><td>" . $row["no_telepon"] . "</td><td>" . $row["email"] . "</td>";
                if (isset($row["id"])) {
                    echo "<td><a href='edit_karyawan.php?id=" . $row["id"] . "'>Edit</a> | <a href='hapus_karyawan.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
                } else {
                    echo "<td>ID tidak ditemukan</td></tr>";
                }
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data karyawan</td></tr>";
        }
        ?>
    </table>

</body>
</html>
