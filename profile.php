<?php
// Koneksi ke database
include 'includes/db.php';

// Ambil data profile dari database
$sql = "SELECT * FROM profile WHERE id = 1"; // Mengambil data profile dengan id 1
$result = mysqli_query($conn, $sql);
$profile = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile - Tour Travel Labuan Bajo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<style>.navbar-brand {
            display: flex;
            align-items: center; /* Vertically center the logo and text */
        }

        .logo {
            width: 30px; /* Atur lebar logo */
            height: auto; /* Otomatis atur tinggi untuk mempertahankan rasio */
            margin-right: 8px; /* Jarak antara logo dan teks */
        }
        </style>
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
                    <a class="nav-link" href="contact_us.php">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
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

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-8">
                <h2><?php echo $profile['title']; ?></h2>
                <p><?php echo $profile['content']; ?></p>
                <h4>Peraturan:</h4>
                <p><?php echo nl2br($profile['peraturan']); ?></p>
                <h4>Penyedia Layanan:</h4>
                <p><?php echo $profile['penyedia_layanan']; ?></p>
                <h4>Penanggung Jawab:</h4>
                <p><?php echo $profile['penanggung_jawab']; ?></p>
            </div>
            <div class="col-md-4">
                <img src="uploads/<?php echo $profile['image_perusahaan']; ?>" class="img-fluid" alt="Image">
                <h5>Kontak Informasi</h5>
                <p><strong>Nama:</strong> <?php echo $profile['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $profile['email']; ?></p>
                <p><strong>Telepon:</strong> <?php echo $profile['phone']; ?></p>
                <p><strong>Alamat:</strong> <?php echo $profile['address']; ?></p>
            </div>
        </div>
    </div>
<br>
<br>
<br>
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
