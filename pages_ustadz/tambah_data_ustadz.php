<?php
require '../config.php';

// siapkan variabel agar tidak error notice
$nama = $kelas = $jilid = $status = $kategori = "";

if (isset($_POST['simpan'])) {

    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    $jilid  = $_POST['jilid'];
    $status = $_POST['status'];
    $kategori = $_POST['kategori'];
    $tanggal = date('Y-m-d');

    // kategori: juzama, alquran, yanbu
    $sql = "INSERT INTO approve (nama, kelas, jilid, status, kategori, tanggal)
            VALUES ('$nama', '$kelas', '$jilid', '$status', '$kategori', '$tanggal')";

    $simpan = $koneksi->query($sql);

    if ($simpan) {
        echo "<script>
                alert('Data berhasil dikirim! Menunggu persetujuan admin/ustadz.');
                window.location='index.php';
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

        <!-- STATUS RADIO -->
        <tr>
            <td>Status</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="lulus" 
                        <?= $status=='lulus'?'checked':'' ?>>
                    <label class="form-check-label">Lulus</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="tidak lulus" 
                        <?= $status=='tidak lulus'?'checked':'' ?>>
                    <label class="form-check-label">Tidak Lulus</label>
                </div>
            </td>
        </tr>

        <!-- KATEGORI RADIO -->
        <tr>
            <td>Kategori</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" value="juzama"
                    <?= $kategori=='juzama'?'checked':'' ?>>
                    <label class="form-check-label">Juz Amma</label>
                </div>
            
            
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" value="alquran"
                    <?= $kategori=='alquran'?'checked':'' ?>>
                    <label class="form-check-label">Al-Qur'an</label>
                </div>
        
            
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" value="yanbu"
                    <?= $kategori=='yanbu'?'checked':'' ?>>
                    <label class="form-check-label">Yan'bu</label>
                </div>
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
                <br>
                <a class="btn btn-secondary mb-3" href="?p=data_juzama_ustadz">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                </br>
            </td>
        </tr>
    </table>
</form>
