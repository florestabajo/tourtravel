session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

include('../includes/db.php'); // koneksi ke database

// Inisialisasi variabel $booking
$booking = null;

// Ambil data booking berdasarkan ID
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if (!$booking) {
        $_SESSION['error_msg'] = "Booking tidak ditemukan!";
        header("Location: manage_bookings.php");
        exit;
    }
}

// Proses update booking
if (isset($_POST['update'])) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $booking_date = $_POST['booking_date'];
    $destination_id = $_POST['destination_id'];

    $update_query = "UPDATE bookings SET user_name = ?, email = ?, phone = ?, booking_date = ?, destination_id = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssii", $user_name, $email, $phone, $booking_date, $destination_id, $booking_id);

    if ($stmt->execute()) {
        $_SESSION['success_msg'] = "Booking berhasil diperbarui!";
        header("Location: manage_bookings.php");
        exit;
    } else {
        $_SESSION['error_msg'] = "Gagal memperbarui booking!";
    }
}

// Ambil daftar destinasi
$dest_query = "SELECT id, name FROM destinations";
$dest_result = $conn->query($dest_query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Edit Booking</title>
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
                <a class="nav-link" href="manage_bookings.php">Bookings</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Edit Booking</h2>

    <!-- Tampilkan pesan sukses atau error -->
    <?php if (isset($_SESSION['success_msg'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?>
        </div>
    <?php endif; ?>

    <!-- Hanya tampilkan form jika booking ditemukan -->
    <?php if ($booking): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo htmlspecialchars($booking['user_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($booking['phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="destination_id">Destination</label>
                <select class="form-control" id="destination_id" name="destination_id" required>
                    <?php while ($row = $dest_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $booking['destination_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update Booking</button>
        </form>
    <?php else: ?>
        <p>Booking tidak ditemukan.</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php include '../includes/footer.php'; ?>
