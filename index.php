<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Data Peminjam</h2>
<?php
include 'database.php';

$sql = "SELECT * FROM peminjam";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>ID Peminjam</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Email</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id_peminjam"] . "</td>
            <td>" . $row["nama"] . "</td>
            <td>" . $row["alamat"] . "</td>
            <td>" . $row["no_telepon"] . "</td>
            <td>" . $row["email"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data peminjam.";
}
?>

<h2>Data Buku</h2>
<?php
$sql = "SELECT * FROM buku";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>ID Buku</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Tahun Terbit</th>
        <th>Penerbit</th>
        <th>Jumlah Stok</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id_buku"] . "</td>
            <td>" . $row["judul"] . "</td>
            <td>" . $row["pengarang"] . "</td>
            <td>" . $row["tahun_terbit"] . "</td>
            <td>" . $row["penerbit"] . "</td>
            <td>" . $row["jumlah_stok"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data buku.";
}
?>

<h2>Data Karyawan</h2>
<?php
$sql = "SELECT * FROM karyawan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>ID Karyawan</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>No Telepon</th>
        <th>Email</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id_karyawan"] . "</td>
            <td>" . $row["nama"] . "</td>
            <td>" . $row["jabatan"] . "</td>
            <td>" . $row["no_telepon"] . "</td>
            <td>" . $row["email"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data karyawan.";
}
?>

</body>
</html>
