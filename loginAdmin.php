<?php
session_start();
require("koneksi.php");

global $koneksi;

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $koneksi->real_escape_string($_POST['email_admin']);
    $password = $koneksi->real_escape_string($_POST['password_admin']);
    $kode = $koneksi->real_escape_string($_POST['kode_anggota']);

    // Tabel dan nama kolom disesuaikan
    $query = "SELECT * FROM akun_admin WHERE email_admin='$email' AND password_admin=MD5('$password') AND kode_anggota='$kode'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $email;
        header("Location: /admintemanramu/overview");
        exit();
    } else {
        $error = "Login gagal! Email, password, atau kode admin salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Teman Ramu</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/login.css">
</head>

<body>
    <div class="login-form">
        <header>
            LOGIN ADMIN
            <img src="images/logotemanramu.png" alt="Logo Teman Ramu">
        </header>

        <?php if (!empty($error)): ?>
            <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" id="loginForm">
            <input type="text" name="email_admin" placeholder="Masukkan Email" required>

            <div style="position: relative;">
                <input type="password" name="password_admin" id="passwordField" placeholder="Masukkan Password" required>
                <span onclick="togglePassword()"
                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                    👁️
                </span>
            </div>

            <input type="text" name="kode_anggota" placeholder="Kode Anggota Admin" required>
            <a href="#">Lupa Password?</a>
            <button type="submit" class="button">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        // Validasi isi semua input
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.querySelector('[name="email_admin"]').value.trim();
            const pass = document.querySelector('[name="password_admin"]').value.trim();
            const kode = document.querySelector('[name="kode_anggota"]').value.trim();

            if (!email || !pass || !kode) {
                alert("Harap isi semua data login terlebih dahulu!");
                e.preventDefault();
            }
        });
    </script>
</body>

</html>