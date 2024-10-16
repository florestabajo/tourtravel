<?php
session_start();
include '../includes/db.php'; // Koneksi ke database

// Get the destination ID from the URL
$id = $_GET['id'];

// Delete query
$query = "DELETE FROM destinations WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header("Location: manage_destinations.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
