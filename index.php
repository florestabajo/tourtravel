<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Destinations - Tour Travel Labuan Bajo</title>
    <style>
        /* CSS Custom untuk halaman */
        .container h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .destinations {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .destination-card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(25% - 20px);
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .destination-card:hover {
            transform: scale(1.05);
        }

        .destination-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
            transition: opacity 0.3s ease;
        }

        .destination-image:hover {
            opacity: 0.85;
        }

        .btn-learn-more {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-learn-more:hover {
            background-color: #218838;
        }

        @media (max-width: 1200px) {
            .destination-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .destination-card {
                width: 100%;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
        <a class="navbar-brand" href="about_us.php">
            <img src="uploads/116422069_652571265616817_7756457524415709461_o__1_-removebg-preview.png" alt="Logo" class="logo"> Tour Travel Labuan Bajo
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
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
                <!-- Formulir Pencarian -->
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" method="GET" action="index.php">
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Cari tempat destinasimu..." aria-label="Search" value="<?php echo htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="privacy_policy.php">Privasi Policy</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://wa.me/+6281238740658">081238740658</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="mailto:lianop290@gmail.com">Kirim Email</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <br><br><br><br>
        <h1>Explore Destinations</h1>
        <p>Liburan di Flores NTT penuh dengan kebahagiaan dengan destinasi wisata yang menakjubkan yang sebelumnya belum kamu kunjungi,Ayo segera pesan paket wisata kami untuk menikamti liburan sepanjang hari</p>

        <div class="destinations">
            <?php
            include 'includes/db.php';

            // Sanitize search input
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM destinations WHERE name LIKE CONCAT('%', ?, '%')");
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                echo "<p>No destinations found matching your search.</p>";
            }

            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['name']);
                $description = htmlspecialchars($row['description']);
                $price = htmlspecialchars($row['price']);
                $image = htmlspecialchars($row['image']);

                $short_description = htmlspecialchars(substr($description, 0, 100)) . '...';
            ?>
                <div class="destination-card">
                    <a href="bookings.php?id=<?php echo $id; ?>">
                        <img src="images/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="destination-image">
                    </a>
                    <h2><?php echo $name; ?></h2>
                    <p><?php echo $short_description; ?></p>
                    <p><strong>Price: $<?php echo number_format($price, 2); ?></strong></p>
                    <a href="destination_detail.php?id=<?php echo $id; ?>" class="btn-learn-more">Learn More</a>
                </div>
            <?php
            }
            $stmt->close();
            ?>
        </div>
        <br>
        <br>
        <br>
        <?php include 'includes/footer.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
