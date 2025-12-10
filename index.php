<?php
session_start();

if (!isset($_SESSION['users']) || $_SESSION['level'] != 'admin') {
    echo "<script>window.location='login.php';</script>";
    exit();
}
?>

