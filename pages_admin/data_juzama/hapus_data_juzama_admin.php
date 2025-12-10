<?php
$id = $_GET['id'];
require '../config.php';

$koneksi->query("DELETE FROM juzama WHERE id='$id'");
echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=data_juzama_admin';</script>";
