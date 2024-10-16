<?php
// Koneksi ke database
include 'includes/db.php';

// Ambil data kebijakan privasi dari database
$sql = "SELECT * FROM privacy_policy WHERE id = 1";
$result = mysqli_query($conn, $sql);
$policy = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Privacy Policy - Tour Travel Labuan Bajo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Custom CSS untuk mobile -->
    <style>
        body {
            padding-top: 70px;
        }
        .privacy-content {
            padding: 20px;
        }
        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }
        @media (max-width: 576px) {
            h1 {
                font-size: 1.5rem;
            }
        }
        .navbar-brand {
            display: flex;
            align-items: center; /* Vertically center the logo and text */
        }

        .logo {
            width: 30px; /* Atur lebar logo */
            height: auto; /* Otomatis atur tinggi untuk mempertahankan rasio */
            margin-right: 8px; /* Jarak antara logo dan teks */
        }
    </style>
</head>
<body id="page-top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
    <a class="navbar-brand" href="about_us.php">
            <img src="uploads/116422069_652571265616817_7756457524415709461_o__1_-removebg-preview.png" alt="Logo" class="logo"> Tour Travel Labuan Bajo
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        Tentang Kami
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Via Wa:081238740658</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Email:Lianop290@gmail.com</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Privacy Policy Content -->
    <div class="container privacy-content">
        <h1><?php echo $policy['title']; ?></h1>
        <p><?php echo nl2br($policy['content']); ?></p>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
<br>
<br>
<br>
<br>
</html>
