<?php
$id = $_GET['id'];
require '../config.php';

$koneksi->query("DELETE FROM alquran WHERE id='$id'");
echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=data_alquran_admin';</script>";
