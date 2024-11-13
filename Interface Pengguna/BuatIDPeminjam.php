<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat ID Peminjam</title>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
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

        #create-id input, #create-id select {
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
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="User  .php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></li>
                <li><a href="daftarbuku.php">Daftar Buku</a></li>
                <li><a href="sejarah.html">Sejarah Perpustakaan</a></li>
                <li><a href="create_id.php">Buat ID Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="create-id">
            <h2>Buat ID Peminjam</h2>
            <form action="proses_create_id.php" method="POST">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required>

                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" name="telepon" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Buat ID Peminjam</button>
            </form>
            <div class="redirect-text">
                <p>Sudah memiliki ID Peminjam? <a href="login.php">Masuk di sini</a></p>
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
            <li><a href="#"><i class