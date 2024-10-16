<?php
// Koneksi ke database
include 'includes/db.php';

// Ambil data dari tabel about_us
$sql = "SELECT * FROM about_us WHERE id = 1"; // Mengambil data about_us dengan id 1
$result = mysqli_query($conn, $sql);
$about = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About Us - Tour Travel Labuan Bajo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            padding-top: 56px;
        }
        .about-section {
            padding: 60px 15px;
        }
        .about-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .about-content {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .about-title {
                font-size: 1.5rem;
            }
            .about-content {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body id="page-top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
        <a class="navbar-brand" href="#">Tour Travel Labuan Bajo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact</a>
                </li>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tentang Kami
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="privacy_policy.php">Privasi Policy</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Via Wa:081238740658</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Email:Lianop290@gmail.com</a>
        </div>
      </li>
            </ul>
        </div>
    </nav>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h1 class="about-title text-center"><?php echo $about['title']; ?></h1>
            <div class="about-content">
                <?php echo nl2br($about['content']); ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
