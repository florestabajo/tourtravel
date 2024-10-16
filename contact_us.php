<?php
// Include database connection file
include 'includes/db.php';

// Initialize variables
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO contact_us (name, email, message, created_at) VALUES (?, ?, ?, NOW())";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_email, $param_message);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to thank you page or display success message
                echo "<script>alert('Message sent successfully!');</script>";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Contact Us - Tour Travel Labuan Bajo</title>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
        <a class="navbar-brand" href="about_us.php">Tour Travel Labuan Bajo</a>
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

    <div class="container mt-5 pt-5">
        <h2>Contact Us</h2>
        <form action="contact_us.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="text-danger"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" class="form-control"><?php echo $message; ?></textarea>
                <span class="text-danger"><?php echo $message_err; ?></span>
            </div>
            <button type="submit" class="btn btn-info">Send Message</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
