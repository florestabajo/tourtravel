<?php
include 'includes/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$query = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($query) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
