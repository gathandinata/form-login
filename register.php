<?php
include 'config.php'; // Memanggil konfigurasi database (yang berisi jebakan)

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validasi sederhana
    if(!empty($username) && !empty($password)) {
        
        // Cek apakah username sudah ada
        $checkQuery = "SELECT * FROM users WHERE username = '$username'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $message = "<div class='alert error'>Username sudah terdaftar!</div>";
        } else {
            // Enkripsi password dengan MD5 (Bad practice, tapi umum untuk pemula/jebakan)
            $passwordHash = md5($password); 
            
            // Query Insert
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";
            
            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert success'>Registrasi Berhasil! Silakan <a href='index.php'>Login</a></div>";
            } else {
                $message = "<div class='alert error'>Error: " . $conn->error . "</div>";
            }
        }
    } else {
        $message = "<div class='alert error'>Semua kolom harus diisi!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun Baru</title>
    <style>
        /* Menggunakan style yang sama dengan login agar konsisten */
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background-color: #f0f2f5; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #218838; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; font-size: 14px;}
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .link { text-align: center; margin-top: 15px; font-size: 14px; }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<div class="login-box">
    <h2 style="text-align: center;">Daftar Akun</h2>
    <?php echo $message; ?>
    
    <form action="" method="post">
        <label>Username Baru</label>
        <input type="text" name="username" placeholder="Buat username" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Buat password" required>
        
        <button type="submit">DAFTAR SEKARANG</button>
    </form>

    <div class="link">
        Sudah punya akun? <a href="index.php">Login di sini</a>
    </div>
</div>

</body>
</html>