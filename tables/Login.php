<?php
session_start(); // Memulai sesi

// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_peminjaman_buku';
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek data login dari database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_name'] = $user['name']; // Simpan nama pengguna di session
                $_SESSION['login_success'] = true;

                // Redirect berdasarkan role
                if ($user['role'] == 'admin') {
                    header("Location: ../index.php?pesan=login");
                } elseif ($user['role'] == 'anggota') {
                    header("Location: ../interface pengguna/user.php?pesan=login");
                }
                exit();
            } else {
                $error_message = "Password salah!";
            }
        } else {
            $error_message = "Email tidak ditemukan!";
        }
        $stmt->close();
    }
}

// Proses pendaftaran (signup)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Simpan data pengguna baru ke database
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'anggota')";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    } else {
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "";
        } else {
            $error_message = "Pendaftaran gagal: email telah diambil!";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Tambahkan SweetAlert -->
</head>
<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <div class="text">
                    <span class="text-1">Every new friend is a <br> new adventure</span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
            <div class="back">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
                    <form action="" ```php
                    method="POST">
                        <div class="input-boxes">
                            <div class ="input-box">
                                <i class="fas fa-user"></i>
                                <input type="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="text"><a href="#">Forgot password?</a></div>
                            <div class="button input-box">
                                <input type="submit" name="login" value="Login">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
                    <form action="" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" name="signup" value="Signup">
                            </div>
                            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menampilkan SweetAlert setelah login berhasil
        <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) { ?>
            Swal.fire({
                title: 'Selamat datang, <?php echo $_SESSION['user_name']; ?>!',
                text: 'Anda berhasil login.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['login_success']); } ?>
    </script>
</body>
</html>