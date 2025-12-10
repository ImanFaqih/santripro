<?php
$id = $_GET['id'];
require '../config.php';

$koneksi->query("DELETE FROM yanbu WHERE id='$id'");
echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=data_yanbu_admin';</script>";
