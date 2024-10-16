<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

include('../includes/db.php'); // koneksi ke database

// Hapus booking jika ada permintaan delete
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $_SESSION['success_msg'] = "Booking berhasil dihapus!";
    } else {
        $_SESSION['error_msg'] = "Gagal menghapus booking!";
    }
    header("Location: manage_bookings.php");
    exit;
}

// Ambil data bookings dari database
$query = "SELECT bookings.id, bookings.user_name, bookings.email, bookings.phone, destinations.name AS destination, bookings.booking_date 
          FROM bookings 
          JOIN destinations ON bookings.destination_id = destinations.id";
$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Manage Bookings</title>
</head>
<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <a class="navbar-brand">Welcome, <?php echo $_SESSION['admin']; ?>!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="add_destination.php">Add Destination</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_profile.php">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Manage Bookings</h2>

    <!-- Pesan Sukses atau Error -->
    <?php if (isset($_SESSION['success_msg'])): ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION['success_msg']; 
            unset($_SESSION['success_msg']); // Hapus pesan setelah ditampilkan
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error_msg']; 
            unset($_SESSION['error_msg']); // Hapus pesan setelah ditampilkan
            ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Destination</th>
                <th>Booking Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <td>
                        <a href="manage_bookings.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('../includes/footer.php');
