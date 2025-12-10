<?php
require '../config.php';

// Daftar nama ustadz berdasarkan ENUM di tabel database santripro (1).sql
$ustadz_lists = [
    'alquran' => ['Syafiqul Umam', 'Nazila Umi Syarifah', 'Ariqoh Nadif'], 
    'juzama'  => ['Aziz Febrianti', 'Azril Mahendra'], 
    'yanbu'   => ['Arya Surya', 'Firja Bahi'], 
];

// siapkan variabel agar tidak error notice
$nama = $kelas = $jilid = $status = $kategori = $halaman = $nama_ustadz = "";

// 1. Ambil nilai untuk Persistence di Form
// Ambil nilai kategori yang terakhir di-submit
$kategori = $_POST['kategori'] ?? '';

// Ambil nilai nama_ustadz yang terakhir di-submit untuk persistence
$nama_ustadz_key = 'nama_ustadz_' . $kategori;
$nama_ustadz = $_POST[$nama_ustadz_key] ?? ''; 

// Ambil nilai form lainnya untuk persistence
$nama = $_POST['nama'] ?? $nama;
$kelas = $_POST['kelas'] ?? $kelas;
$jilid = $_POST['jilid'] ?? $jilid;
$halaman = $_POST['halaman'] ?? $halaman;
$status = $_POST['status'] ?? $status;


if (isset($_POST['simpan'])) {
    
    // 2. CEK KONEKSI KRITIS: Hentikan eksekusi jika koneksi gagal.
    if (!$koneksi || $koneksi->connect_error) {
        die("<div class='container mt-5'><div class='alert alert-danger'>FATAL ERROR: Koneksi database gagal. Pastikan file config.php sudah benar. Error: " . ($koneksi->connect_error ?? "Tidak diketahui.") . "</div></div>");
    }

    $tanggal = date('Y-m-d');
    
    // 3. AMBIL NILAI POST YANG AMAN DAN SANITASI (Menggunakan ?? '' untuk mencegah 'Undefined index')
    $submitted_kategori = $_POST['kategori'] ?? '';
    
    // Ambil nilai ustadz yang dikirim, hanya satu yang ada di $_POST
    $ustadz_key = 'nama_ustadz_' . $submitted_kategori;
    $nama_ustadz_submitted = $_POST[$ustadz_key] ?? '';
    
    // Sanitasi semua data
    $safe_nama = $koneksi->real_escape_string($_POST['nama'] ?? '');
    $safe_kelas = $koneksi->real_escape_string($_POST['kelas'] ?? '');
    $safe_jilid = $koneksi->real_escape_string($_POST['jilid'] ?? '');
    $safe_halaman = $koneksi->real_escape_string($_POST['halaman'] ?? '');
    $safe_status = $koneksi->real_escape_string($_POST['status'] ?? '');
    $safe_kategori = $koneksi->real_escape_string($submitted_kategori);
    $safe_ustadz = $koneksi->real_escape_string($nama_ustadz_submitted); // Data ustadz yang disubmit

    // QUERY INSERT TELAH DIPERBAIKI
    $sql = "INSERT INTO approve (nama, kelas, jilid, halaman, status, nama_ustadz, kategori, tanggal)
            VALUES ('$safe_nama', '$safe_kelas', '$safe_jilid', '$safe_halaman', '$safe_status', '$safe_ustadz', '$safe_kategori', '$tanggal')";

    $simpan = $koneksi->query($sql);

    if ($simpan) {
        echo "<script>
                alert('Data berhasil dikirim! Menunggu persetujuan admin/ustadz.');
                window.location='index.php';
              </script>";
    } else {
        // Tampilkan error SQL jika terjadi
        echo "<div class='container mt-5'><div class='alert alert-danger'>Gagal menyimpan data (SQL Error): " . $koneksi->error . "</div></div>";
    }
}

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Input Data Baru (Approval)</h4>
        </div>
        <div class="card-body">

            <form method="post" action="" id="inputForm">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-md-3 align-middle">Nama</td>
                        <td class="col-md-9">
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-3 align-middle">Kelas</td>
                        <td class="col-md-9">
                            <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($kelas) ?>" required>
                        </td>
                    </tr> 

                    <tr>
                        <td class="col-md-3 align-middle">Jilid/Juz</td>
                        <td class="col-md-9">
                            <input type="text" name="jilid" class="form-control" value="<?= htmlspecialchars($jilid) ?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-3 align-middle">Halaman</td>
                        <td class="col-md-9">
                            <input type="text" name="halaman" class="form-control" value="<?= htmlspecialchars($halaman) ?>" required>
                            <small class="form-text text-muted">Contoh: 1, 15, atau 20-30</small>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="col-md-3 align-middle">Kategori</td>
                        <td class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input kategori-radio" type="radio" name="kategori" value="juzama" id="katJuzama"
                                <?= $kategori=='juzama'?'checked':'' ?> required>
                                <label class="form-check-label" for="katJuzama">Juz Amma</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input kategori-radio" type="radio" name="kategori" value="alquran" id="katAlquran"
                                <?= $kategori=='alquran'?'checked':'' ?> required>
                                <label class="form-check-label" for="katAlquran">Al-Qur'an</label>
                            </div>
                    
                            <div class="form-check form-check-inline">
                                <input class="form-check-input kategori-radio" type="radio" name="kategori" value="yanbu" id="katYanbu"
                                <?= $kategori=='yanbu'?'checked':'' ?> required>
                                <label class="form-check-label" for="katYanbu">Yanbu'a</label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="col-md-3 align-middle">Nama Ustadz</td>
                        <td class="col-md-9">
                            <div id="ustadz-select-container">
                                <small class="text-muted" id="placeholder-text" style="<?= empty($kategori) ? 'display:block;' : 'display:none;' ?>">Pilih kategori terlebih dahulu.</small>
                                
                                <?php foreach ($ustadz_lists as $key => $list): ?>
                                    <select name="nama_ustadz_<?= $key ?>" id="ustadz_<?= $key ?>" class="form-select ustadz-select" style="display:none;" disabled required>
                                        <option value="" disabled <?= empty($nama_ustadz) ? 'selected' : '' ?>>-- Pilih Ustadz <?= ucwords($key) ?> --</option>
                                        <?php foreach ($list as $ustadz): ?>
                                            <option value="<?= htmlspecialchars($ustadz) ?>" 
                                                    <?= $nama_ustadz == $ustadz && $kategori == $key ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($ustadz) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endforeach; ?>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td class="col-md-3 align-middle">Status</td>
                        <td class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="lulus" id="statusLulus" 
                                    <?= $status=='lulus'?'checked':'' ?> required>
                                <label class="form-check-label" for="statusLulus">Lulus</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="tidak lulus" id="statusTidakLulus" 
                                    <?= $status=='tidak lulus'?'checked':'' ?> required>
                                <label class="form-check-label" for="statusTidakLulus">Tidak Lulus</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td class="col-md-3 align-middle">Tanggal</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 me-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a class="btn btn-secondary mt-3" href="?p=data_juzama_ustadz">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('.kategori-radio');
        const placeholderText = document.getElementById('placeholder-text');

        function updateUstadzSelect() {
            const selectedKategori = document.querySelector('input[name="kategori"]:checked');

            // Sembunyikan semua select dan nonaktifkan requirement
            document.querySelectorAll('.ustadz-select').forEach(select => {
                select.style.display = 'none';
                select.disabled = true;
                select.required = false;
            });

            if (selectedKategori) {
                // Sembunyikan placeholder
                placeholderText.style.display = 'none';
                
                // Tampilkan dan aktifkan select yang relevan
                const selectId = 'ustadz_' + selectedKategori.value;
                const activeSelect = document.getElementById(selectId);
                
                if (activeSelect) {
                    activeSelect.style.display = 'block';
                    activeSelect.disabled = false;
                    activeSelect.required = true;
                }
            } else {
                // Tampilkan placeholder jika belum ada yang dipilih
                placeholderText.style.display = 'block';
            }
        }

        // Jalankan saat halaman dimuat (untuk menjaga state setelah error/reload)
        updateUstadzSelect();

        // Tambahkan event listener untuk radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', updateUstadzSelect);
        });
    });
</script>
<?php
// Tutup koneksi
