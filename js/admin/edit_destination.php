<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM destinations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $destination = $result->fetch_assoc();
} else {
    header("Location: manage_destinations.php");
    exit;
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Cek apakah ada file gambar yang diunggah
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $valid_extensions)) {
            // Upload file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Hapus gambar lama jika ada
                if (!empty($destination['image'])) {
                    unlink($target_dir . $destination['image']);
                }
            } else {
                echo "<script>alert('Error uploading image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        }
    } else {
        // Jika tidak ada gambar baru diunggah, tetap gunakan gambar yang lama
        $image = $destination['image'];
    }

    // Update database
    $query = "UPDATE destinations SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdsi', $name, $description, $price, $image, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Destination updated successfully!'); window.location='manage_destinations.php';</script>";
    } else {
        echo "<script>alert('Error updating destination.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Edit Destination</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <a class="navbar-brand">Welcome, <?php echo $_SESSION['admin']; ?>!</a>
</nav>

<div class="container" style="margin-top: 80px;">
    <h1>Edit Destination</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Destination Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $destination['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $destination['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $destination['price']; ?>" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <?php if (!empty($destination['image'])): ?>
                <p>Current Image: <img src="../images/<?php echo $destination['image']; ?>" width="100" alt="Current Image"></p>
            <?php endif; ?>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Destination</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
