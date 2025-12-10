<?php
require '../config.php';

// siapkan variabel agar tidak error notice
$nama = $kelas = $jilid = $status = "";

if (isset($_POST['simpan'])) {

    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    $jilid  = $_POST['jilid'];
    $status = $_POST['status'];
    $tanggal = date('Y-m-d');

    $sql = "INSERT INTO juzama (nama, kelas, jilid, status, tanggal)
            VALUES ('$nama', '$kelas', '$jilid', '$status', '$tanggal')";

    $simpan = $koneksi->query($sql);

    if ($simpan) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location='?p=data_juzama_admin';
              </script>";
    } else {
        echo "Gagal menyimpan data: " . $koneksi->error;
    }
}
?>

<form method="post" action="">
    <table>
        <tr>
            <td>Nama</td>
            <td>
                <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
            </td>
        </tr>

        <tr>
            <td>Kelas</td>
            <td>
                <input type="text" name="kelas" class="form-control" value="<?= $kelas ?>">
            </td>
        </tr> 

        <tr>
            <td>Jilid</td>
            <td>
                <input type="text" name="jilid" class="form-control" value="<?= $jilid ?>">
            </td>
        </tr>

        <tr>
            <td>Status</td>
            <td>
                <select name="status" class="form-control" required>
                    <option value="">-- pilih status --</option>
                    <option value="lulus"   <?= $status=='lulus'?'selected':'' ?>>lulus</option>
                    <option value="tidak lulus"  <?= $status=='tidak lulus'?'selected':'' ?>>tidak lulus</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td>
                <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
                <br></br>
                <a class="btn btn-secondary mb-3" href="?p=data_juzama_admin">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </td>
        </tr>
    </table>
</form>