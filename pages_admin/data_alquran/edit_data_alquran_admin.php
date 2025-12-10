<form method="post" action="">
<?php
require_once '../config.php';

// --- CEK ID UNTUK MENGHINDARI ERROR ---
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ERROR: ID tidak ditemukan di URL!");
}

// --- PROSES UPDATE ---
if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    $jilid  = $_POST['jilid'];
    $status = $_POST['status'];

    $sql = "UPDATE alquran SET 
                nama='$nama', 
                kelas='$kelas', 
                jilid='$jilid', 
                status='$status' 
            WHERE id='$id'";

    $koneksi->query($sql);

    echo  "<script>alert('Data berhasil diupdate'); window.location='';</script>
";
}

// --- TAMPILKAN DATA YANG AKAN DIEDIT ---
$sql  = "SELECT * FROM alquran WHERE id='$id'";
$data = $koneksi->query($sql);

foreach ($data as $row) {
    ?>
    
    <table class='table table-bordered table-hover'>
        <tr>
            <th>Nama</th>
            <td><input type='text' name='nama' class='form-control' value='<?= $row['nama']; ?>' required></td>
        </tr>

        <tr>
            <th>Kelas</th>
            <td><input type='text' name='kelas' class='form-control' value='<?= $row['kelas']; ?>' required></td>
        </tr>

        <tr>
            <th>Jilid</th>
            <td><input type='text' name='jilid' class='form-control' value='<?= $row['jilid']; ?>' required></td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <select name='status' class='form-control' required>
                    <option value='lulus'       <?= $row['status']=='lulus' ? 'selected' : '' ?>>Lulus</option>
                    <option value='tidak lulus' <?= $row['status']=='tidak lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan='2'>
                <button type='submit' name='submit' class='btn btn-success btn-sm'>Update</button>
            </td>
        </tr>
    </table>

    <?php
}
?>
    <a href="?p=data_alquran_admin" class="btn btn-primary btn-sm">Kembali</a>
</form>
