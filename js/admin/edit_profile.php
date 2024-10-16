<?php
session_start();
include '../includes/db.php'; // Koneksi ke database

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data profile dari database
$query = "SELECT * FROM profile WHERE id = 1";
$result = mysqli_query($conn, $query);
$profile = mysqli_fetch_assoc($result);

// Update profile jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $peraturan = $_POST['peraturan'];
    $penyedia_layanan = $_POST['penyedia_layanan'];
    $penanggung_jawab = $_POST['penanggung_jawab'];

    // Proses upload image jika ada
    $image = $_FILES['image_perusahaan']['name'];
    $target = "uploads/" . basename($image);
    if (move_uploaded_file($_FILES['image_perusahaan']['tmp_name'], $target)) {
        // Update profil dengan gambar baru
        $update_query = "UPDATE profile SET 
            name='$name', email='$email', phone='$phone', address='$address', 
            title='$title', content='$content', peraturan='$peraturan', 
            penyedia_layanan='$penyedia_layanan', penanggung_jawab='$penanggung_jawab', 
            image_perusahaan='$image' WHERE id=1";
    } else {
        // Update profil tanpa gambar
        $update_query = "UPDATE profile SET 
            name='$name', email='$email', phone='$phone', address='$address', 
            title='$title', content='$content', peraturan='$peraturan', 
            penyedia_layanan='$penyedia_layanan', penanggung_jawab='$penanggung_jawab'
            WHERE id=1";
    }
    mysqli_query($conn, $update_query);
    header("Location: edit_profile.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Edit Profile</title>
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
          <li class="nav-item">
            <a class="nav-link" href="admin_dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container" style="margin-top: 80px;">
      <h2>Edit Profile</h2>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $profile['name']; ?>" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $profile['email']; ?>" required>
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control" value="<?php echo $profile['phone']; ?>">
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea name="address" class="form-control"><?php echo $profile['address']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" class="form-control" value="<?php echo $profile['title']; ?>">
        </div>
        <div class="form-group">
          <label>Content</label>
          <textarea name="content" class="form-control"><?php echo $profile['content']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Peraturan</label>
          <textarea name="peraturan" class="form-control"><?php echo $profile['peraturan']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Penyedia Layanan</label>
          <input type="text" name="penyedia_layanan" class="form-control" value="<?php echo $profile['penyedia_layanan']; ?>">
        </div>
        <div class="form-group">
          <label>Penanggung Jawab</label>
          <input type="text" name="penanggung_jawab" class="form-control" value="<?php echo $profile['penanggung_jawab']; ?>">
        </div>
        <div class="form-group">
          <label>Upload Image Perusahaan</label>
          <input type="file" name="image_perusahaan" class="form-control">
          <img src="uploads/<?php echo $profile['image_perusahaan']; ?>" alt="Image" width="100">
        </div>
        <button type="submit" class="btn btn-info">Update Profile</button>
      </form>
    </div>
    <br>
    <br>
    <br>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>
<?php include ('../includes/footer.php');