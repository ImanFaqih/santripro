<div class="col-6">
    <?php
    require_once '../config.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM juzama WHERE id='$id'";
    $data = $koneksi->query($sql);
    foreach ($data as $row) {
    

    echo"
    <table class='table table-bordered table-hover tabel-striped'>
        <tr>
            <th>Nama</th>
            <td>$row[nama]</td>
        </tr>

        <tr>
            <th>Kelas</th>
            <td>$row[kelas]</td>
        </tr>

        <tr>
            <th>Jilid</th>
            <td>$row[jilid]</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>$row[status]</td>
        </tr>

        <tr>
            <th>Tanggal Pengajuan</th>
            <td>$row[tanggal]</td>
        </tr>
    </table>
    ";
    }
    ?>

    <a href="index.php" class="btn btn-primary btn-sm">Kembali</a>
</div>