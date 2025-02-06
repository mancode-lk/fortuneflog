<?php
include 'conn.php';
if (isset($_SESSION['admin_id'])) {
    session_destroy();
    unset($_SESSION['admin_id']); // Unset the admin session variable
}

header('location:../login.php');
exit();
 ?>
