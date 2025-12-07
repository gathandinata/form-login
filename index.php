<?php
// MENGHUBUNGKAN KE CONFIG (FILE JEBAKAN)
// Pastikan file config.php ada di satu folder yang sama
include 'config.php'; 

session_start(); // Memulai session

$message = "";

// LOGIKA LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi MD5 (Sengaja dibuat tidak aman untuk standar modern)

    // Mencegah error jika input kosong
    if (!empty($username) && !empty($password)) {
        // Query Database
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            $message = "<div class='alert success'>Login Berhasil! Halo, " . htmlspecialchars($username) . ".</div>";
        } else {
            $message = "<div class='alert error'>Username atau Password salah!</div>";
        }
    } else {
        $message = "<div class='alert error'>Harap isi semua kolom!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Login Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 350px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-header h2 {
            margin: 0;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box; /* Agar padding tidak melebarkan input */
        }
        /* TOMBOL LOGIN (BIRU) */
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        /* TOMBOL REGISTER (HIJAU) */
        .btn-register {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Menghilangkan garis bawah link */
            font-size: 16px;
            box-sizing: border-box;
            font-weight: bold;
        }
        .btn-register:hover {
            background-color: #218838;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .separator {
            text-align: center;
            margin: 10px 0;
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h2>Silakan Login</h2>
        <p style="color: gray; font-size: 14px;">Masukkan kredensial Anda</p>
    </div>

    <?php echo $message; ?>

    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Contoh: admin" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>

        <button type="submit" class="btn-login">MASUK</button>
    </form>

    <div class="separator">atau</div>

    <a href="register.php" class="btn-register">DAFTAR AKUN BARU</a>
</div>

</body>
</html>