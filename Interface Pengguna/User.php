<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Home</title>
    <script src="https://kit.fontawesome.com/1c46902ba5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Interface Pengguna/usercss.css">
    <style>
        body {
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }
        header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #3A415D;
            color: white;
        }
        header img {
            width: 50px; /* Ukuran gambar logo */
            height: auto;
            margin-right: 10px; /* Jarak antara gambar dan teks */
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
        #intro-section {
            padding: 20px;
        }
        .intro-content {
            display: flex;
            align-items: center;
        }
        .intro-image img {
            max-width: 100%;
            height: auto;
        }
        footer {
            background-color: #3A415D;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        .info-kiri, .info-kanan {
            width: 48%;
        }
        .info-kanan ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
        }
        .header-title {
            font-size: 1.5em; /* Ukuran teks lebih kecil */
        }
    </style>
</head>
<body>
    <header>
        <img src="../assets/img/kaiadmin/strada1.png" alt="Logo Perpustakaan"> <!-- Gambar logo -->
        <h1 class="header-title">Perpustakaan Sekolah</h1>
        <nav>
            <ul>
                <li><a href="user.php">Home</a></li>
                <li><a href="peminjaman.php">Peminjaman Buku</a></li>
                <li><a href="daftarbuku.php">Daftar Buku</a></li>
                <li><a href="sejarah.html">Sejarah Perpustakaan</a></li>
                <li><a href="BuatIDPeminjam.php">Buat ID Peminjam</a></li>
                <li><a href="profil.php">Profil Saya</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="../tables/login.php" class="auth-btn login-btn">Login</a>
            <a href="../tables/login.php" class="auth-btn logout-btn">Logout</a>
        </div>
    </header>

    <main>
        <section id="intro-section">
            <div class="intro-content">
                <div class="intro-image">
                    <img src="../assets/img/kaiadmin/Strada.png" alt="Perpustakaan">
                </div>
                <div class="intro-text">
                    <h2>Selamat datang di Perpustakaan Sekolah!</h2>
                    <p>Kami menyediakan berbagai koleksi buku untuk menunjang pendidikan dan pengetahuan Anda. Silakan jelajahi koleksi kami dan lakukan peminjaman buku secara online.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="info-kiri">
            <h2>Kontak Kami</h2>
            <p>Jika Anda memiliki pertanyaan , silakan hubungi kami di:</p>
            <p>Email: perpustakaan@sekolah.com</p>
            <p>Telepon: (021) 98765432</p>
            <p>&copy; 2024 Perpustakaan Sekolah. All rights reserved.</p>
        </div>
        
        <div class="info-kanan">
            <ul>
                <li><a href="#"><i class="fa-solid fa-envelope-open-text"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
            </ul>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>