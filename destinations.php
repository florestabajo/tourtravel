<?php
include 'includes/db.php';
include 'includes/header.php';

$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Destinations</h1>";
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Price: $" . $row['price'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No destinations found.";
}

include 'includes/footer.php';
?>
