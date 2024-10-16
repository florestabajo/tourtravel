<?php
include 'includes/db.php'; // Koneksi ke database

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil detail destinasi
$query = "SELECT * FROM destinations WHERE id = $id";
$result = mysqli_query($conn, $query);
$destination = mysqli_fetch_assoc($result);

if (!$destination) {
    echo "Destination not found!";
    exit;
}

$name = $destination['name'];
$description = $destination['description'];
$price = $destination['price'];
$image = $destination['image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> - Destination Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1><?php echo $name; ?></h1>
        <img src="images/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid">
        <p><?php echo $description; ?></p>
        <p><strong>Price: $<?php echo number_format($price, 2); ?></strong></p>
        <a href="index.php" class="btn btn-primary">Back to Destinations</a>
    </div>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        
        .container {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        img {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            color: #333;
        }

        strong {
            color: #28a745;
            font-size: 1.2em;
        }

        .btn-primary {
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5em;
            }

            strong {
                font-size: 1em;
            }
        }
    </style>
</body>
</html>
