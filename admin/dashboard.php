<?php
session_start();

// Cek apakah user sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['admin']) && !isset($_COOKIE['admin_login'])) {
    header("Location: login.php");
    exit();
}

// Jika login dari cookie, set session
if (isset($_COOKIE['admin_login'])) {
    $_SESSION['admin'] = $_COOKIE['admin_login'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #343a40;
            overflow: hidden;
            position: relative;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #495057;
        }
        .navbar .logout-button {
            display: inline-block;
            background-color: #d9534f;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 3px;
        }
        .navbar .logout-button:hover {
            background-color: #c9302c;
        }
        .hamburger {
            display: none;
            font-size: 30px;
            color: white;
            cursor: pointer;
            padding: 14px 20px;
            float: right;
        }
        .menu {
            display: none; /* Hide by default */
            flex-direction: column;
            position: absolute;
            background-color: #343a40;
            top: 50px;
            width: 100%;
            z-index: 1;
        }
        .menu a {
            float: none;
            text-align: left;
            padding: 10px;
            border-top: 1px solid #495057;
        }
        @media (max-width: 768px) {
            .navbar a {
                display: none; /* Hide the links by default */
            }
            .hamburger {
                display: block; /* Show the hamburger icon */
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="hamburger" onclick="toggleMenu()">☰</div>
        <div class="menu" id="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_destinations.php">Manage Destinations</a>
            <a href="manage_bookings.php">Manage Bookings</a>
            <a href="settings.php">Settings</a>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
        <div class="desktop-menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_destinations.php">Manage Destinations</a>
            <a href="manage_bookings.php">Manage Bookings</a>
            <a href="settings.php">Settings</a>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
        <!-- Konten dashboard lainnya bisa ditambahkan di sini -->
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            if (menu.style.display === "flex") {
                menu.style.display = "none"; // Sembunyikan menu jika sudah ditampilkan
            } else {
                menu.style.display = "flex"; // Tampilkan menu jika belum ditampilkan
            }
        }
    </script>
</body>
</html>
