<?php
include 'includes/db.php'; // Koneksi ke database

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Query untuk mengambil detail destinasi
    $query = "SELECT * FROM destinations WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Ambil gambar tambahan dari tabel (misalnya, tabel `destination_images`)
    $imageQuery = "SELECT image FROM destination_images WHERE destination_id = $id LIMIT 5";
    $imageResult = mysqli_query($conn, $imageQuery);
    $images = [];
    
    while($imageRow = mysqli_fetch_assoc($imageResult)) {
        $images[] = $imageRow['image'];
    }

    // Siapkan data untuk dikirim ke JavaScript
    $response = [
        'name' => $row['name'],
        'description' => $row['description'],
        'images' => $images
    ];
    
    echo json_encode($response);
}
?>
