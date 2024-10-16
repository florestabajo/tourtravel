<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Booking Tour Travel</title>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
        <a class="navbar-brand" href="#">Tour Travel Labuan Bajo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link js-toggle-right" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link js-toggle-right" href="#">About <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link js-toggle-right" href="#">Profile <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link js-toggler-right" href="#">Contact <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Privasi Policy</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Via Wa:081238740658</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Email:Lianop290@gmail.com</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
<?php
include 'includes/db.php'; // Koneksi ke database

// Cek jika ada ID destinasi yang diteruskan
if (isset($_GET['id'])) {
    $destination_id = intval($_GET['id']);
    
    // Query untuk mendapatkan data destinasi berdasarkan ID
    $query = "SELECT * FROM destinations WHERE id = $destination_id";
    $result = mysqli_query($conn, $query);
    $destination = mysqli_fetch_assoc($result);

    // Jika destinasi ditemukan, tampilkan informasi booking
    if ($destination) {
        $destination_name = $destination['name'];
        $price = $destination['price'];
    } else {
        echo "<h2>Destination not found!</h2>";
        exit();
    }
} else {
    echo "<h2>Invalid request!</h2>";
    exit();
}

// Proses form pemesanan
$booking_success = false; // Variabel untuk mengecek apakah booking berhasil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);

    // Query untuk menyimpan data pemesanan
    $insert_query = "INSERT INTO bookings (user_name, email, phone, destination_id, booking_date) VALUES ('$user_name', '$email', '$phone', $destination_id, '$booking_date')";
    
    if (mysqli_query($conn, $insert_query)) {
        $booking_success = true; // Set variabel menjadi true jika booking sukses
    } else {
        echo "<h3>Error: " . mysqli_error($conn) . "</h3>";
    }
}
?>

<!-- Konten Utama -->
<div class="container">
    <link rel="stylesheet" href="css/index.css"> <!-- Link ke file CSS -->
    <br><br><br><br>

    <?php if ($booking_success): ?>
        <!-- Pesan Sukses -->
        <div class="success-message">
            <h3>Booking for <?php echo $destination_name; ?> was successful!</h3>
            <p>Thank you, <?php echo htmlspecialchars($user_name); ?>! Your booking for <?php echo $destination_name; ?> on <?php echo $booking_date; ?> has been confirmed.</p>
            <p>You will receive a confirmation email at <?php echo $email; ?>.</p>
            <a href="index.php" class="btn btn-success">Back to Home</a>
            <a href="destination.php?id=<?php echo $destination_id; ?>" class="btn btn-secondary">View Destination</a>
        </div>
    <?php else: ?>
        <!-- Form Booking -->
        <h1 align="center">Booking for <?php echo $destination_name; ?></h1>
        <p>Price: $<?php echo number_format($price, 2); ?></p>

        <form method="POST">
            <div class="form-group">
                <label for="user_name">Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </form>
    <?php endif; ?>
</div>
<br>
<br>
<br>

<style>
    .success-message {
        text-align: center;
        background-color: #d4edda;
        color: #155724;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #c3e6cb;
        margin-top: 20px;
    }
    .btn {
        margin-top: 20px;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
    }
    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
    }
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 5px;
    }
</style>

    <style>/* Resetting default styles for the form */
form {
    max-width: 500px; /* Maximum width of the form */
    margin: 20px auto; /* Center the form horizontally */
    padding: 20px; /* Padding inside the form */
    background-color: #f9f9f9; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Styling the form groups */
.form-group {
    margin-bottom: 15px; /* Space between form groups */
}

/* Styling labels */
label {
    display: block; /* Make label take full width */
    margin-bottom: 5px; /* Space between label and input */
    font-weight: bold; /* Bold text for labels */
}

/* Styling input fields */
.form-control {
    width: 100%; /* Full width for input fields */
    padding: 10px; /* Padding inside input fields */
    border: 1px solid #ccc; /* Light border */
    border-radius: 4px; /* Rounded corners for inputs */
    box-sizing: border-box; /* Include padding and border in element's total width */
}

/* Change border color on focus */
.form-control:focus {
    border-color: #007bff; /* Change border color to primary color on focus */
    outline: none; /* Remove default outline */
}

/* Styling the submit button */
.btn {
    padding: 10px 15px; /* Padding inside the button */
    background-color: #007bff; /* Primary color for button */
    color: white; /* Text color for button */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners for button */
    cursor: pointer; /* Change cursor to pointer */
    transition: background-color 0.3s; /* Smooth transition for background color */
}

/* Change background color on hover */
.btn:hover {
    background-color: #0056b3; /* Darker shade for hover effect */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    form {
        padding: 15px; /* Adjust padding for smaller screens */
    }

    .form-control {
        padding: 8px; /* Reduce padding inside inputs */
    }

    .btn {
        width: 100%; /* Full width for buttons on mobile */
    }
}

</style>

    <?php include 'includes/footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
