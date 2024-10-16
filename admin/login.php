<?php
session_start();
include '../includes/db.php'; // Koneksi ke database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username di database
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Verifikasi password
    if ($admin && password_verify($password, $admin['password'])) {
        // Cek apakah Remember Me dicentang
        if (isset($_POST['remember'])) {
            setcookie("admin_login", $admin['username'], time() + (86400 * 30), "/"); // 30 hari
        } else {
            // Jika tidak dicentang, tampilkan pesan error
            $error = "Anda harus mencentang 'Remember Me' untuk login.";
        }

        // Set session jika Remember Me dipilih
        if (isset($_POST['remember'])) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        /* CSS untuk efek getar dan menghilangkan pesan */
        .error {
            color: red;
            animation: shake 0.5s; /* Animasi getar */
            display: inline-block;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <script>
        // Menghilangkan pesan error setelah 2 detik
        window.onload = function() {
            const errorElement = document.querySelector('.error');
            if (errorElement) {
                setTimeout(function() {
                    errorElement.classList.add('hidden');
                }, 2000); // 2000 ms = 2 detik
            }
        };
    </script>
</body>
</html>
