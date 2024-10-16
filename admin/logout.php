<?php
session_start();

// Hapus session dan cookie
session_unset();
session_destroy();

if (isset($_COOKIE['admin_login'])) {
    setcookie("admin_login", "", time() - 3600, "/"); // Hapus cookie
}

header("Location: login.php");
exit();
?>
