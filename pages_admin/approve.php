<?php
require '../config.php';

$id = $_GET['id'] ?? 0;
$tolak = $_GET['tolak'] ?? 0;

// Cek ID
$q = $koneksi->query("SELECT * FROM approve WHERE id='$id'");


$data = $q->fetch_assoc();

// Ambil data, termasuk halaman dan nama_ustadz
$nama = $data['nama'];
$kelas = $data['kelas'];
$jilid = $data['jilid'];
$halaman  = $data['halaman'];      // <--- DITAMBAHKAN: Mengambil kolom halaman
$status  = $data['status'];
$tanggal = $data['tanggal'];
$kategori = $data['kategori'];
$nama_ustadz = $data['nama_ustadz']; // <--- DITAMBAHKAN: Mengambil kolom nama_ustadz

// Jika ditolak
if ($tolak == 1) {
$koneksi->query("DELETE FROM approve WHERE id='$id'");
echo "<script>alert('Data ditolak!'); window.location='index.php';</script>";
exit;
}

// Jika diterima
switch ($kategori) {
case 'juzama':
$koneksi->query("INSERT INTO juzama (nama, kelas, jilid, halaman, status, tanggal, nama_ustadz)
VALUES ('$nama', '$kelas', '$jilid', '$halaman', '$status', '$tanggal', '$nama_ustadz')");
break;

case 'alquran':
$koneksi->query("INSERT INTO alquran (nama, kelas, jilid, halaman, status, tanggal, nama_ustadz)
VALUES ('$nama', '$kelas', '$jilid', '$halaman', '$status', '$tanggal', '$nama_ustadz')");
break;

case 'yanbu':
$koneksi->query("INSERT INTO yanbu (nama, kelas, jilid, halaman, status, tanggal, nama_ustadz)
VALUES ('$nama', '$kelas', '$jilid', '$halaman', '$status', '$tanggal', '$nama_ustadz')");
break;
}

// Tandai approved
$koneksi->query("UPDATE approve SET approved=1 WHERE id='$id'");

echo "<script>
alert('Data berhasil di-approve!');
window.location='index.php';
</script>";
?>